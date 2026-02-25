<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ColocationMember;
use App\Models\ExpenseDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ColocationController extends Controller
{
    public function index()
    {
        $active = Colocation::active()->with(['members', "owner"])->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->first();

        $inactives = Colocation::inactive()->with('members')->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $count = Colocation::with('members')->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        return view('colocation.index', compact('active', 'inactives','count'));
    }

    public function show(Colocation $colocation){
        $period = request('month-year');

        if ($period) {
            [$year, $month] = explode('-', $period);
        } else {
            $year = now()->year;
            $month = now()->month;
        }

        $colocation->load(['members.createdExpenses.category','members.createdExpenses.creator.user', "owner", "categories"]);

        $expenses = $colocation->members
            ->flatMap(fn ($member) => $member->createdExpenses)
            ->filter(fn ($expense) =>
                $expense->created_at->year == $year &&
                $expense->created_at->month == $month
            )
            ->sortByDesc('created_at')
            ->values();

        $total_amount = $expenses->sum('amount');

        $currentMember = $colocation->members
            ->firstWhere('user_id', Auth::id());

        $currentMemberAmount = $expenses
            ->where('creator_member_id', $currentMember->id)
            ->sum('amount');

        $otherMembersAmount = $expenses
            ->where('creator_member_id', '!=', $currentMember->id)
            ->sum('amount');

        $sold = $currentMemberAmount - $otherMembersAmount;

        $colocation->members = $colocation->members
            ->filter(fn ($member) => $member->user_id != Auth::id())
            ->map(function ($member) use ($currentMember, $year, $month) {

                $owed_to_user = ExpenseDetail::where('status', 'PENDING')
                    ->where('debtor_member_id', $member->id)
                    ->whereHas('expense', function ($query) use ($currentMember, $year, $month) {
                        $query->where('creator_member_id', $currentMember->id)
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month);
                    })
                    ->sum('amount');

                $user_owes = ExpenseDetail::where('status', 'PENDING')
                    ->where('debtor_member_id', $currentMember->id)
                    ->whereHas('expense.creator', function ($query) use ($member, $year, $month) {
                        $query->where('id', $member->id)
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month);
                    })
                    ->sum('amount');

                $member->owed = $owed_to_user - $user_owes;

                return $member;
            })
            ->values();

        return view("colocation.show", compact("colocation", "expenses", "total_amount", "sold"));
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validateWithBag('addColocation');

        $activeCount = Colocation::active()->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        if($activeCount > 0){
            return back()->with('addColocationError','You already have an active colocation');
        }

        $colocation = Colocation::create([
            "name"=> $request->name,
            "description" => $request->description
        ]);

        $colocation->members()->create([
            "user_id" => Auth::id(),
            "role" => "Owner"
        ]);

        return redirect()->route("colocation.index")->with("success","Colocation created successfully");
    }

    public function destroy(Colocation $colocation){
        $members = $colocation->members()->get();
        foreach($members as $member){
            $withoutDebts = ($member->debts()->where('status', "PAID")->sum("amount") - $member->debts()->where('status', "PENDING")->sum("amount")) === 0;
            if($withoutDebts){
                User::where("id", $member->user_id)->increment("reputation", 1);
            }else{
                User::where("id", $member->user_id)->decrement("reputation", 1);
            }
        }

        $colocation->update([
            "status" => "DESACTIVE",
        ]);

        return redirect()->route("colocation.index")->with("success","Colocation deleted successfully");
    }
}
