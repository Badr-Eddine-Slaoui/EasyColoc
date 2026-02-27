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
            $query->where('user_id', Auth::id())
                ->whereNull('left_at');
        })->first();

        $inactives = Colocation::with('members')
            ->where(function ($query) {
                $query->where('status', 'DESACTIVE')
                    ->orWhereHas('members', function ($q) {
                        $q->where('user_id', Auth::id())
                        ->whereNotNull('left_at');
                    });
            })
            ->whereHas('members', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

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

        $colocation->load(['members.createdExpenses.category','members.createdExpenses.creator.user', 'members.createdExpenses.details.debtor.user', 'members.createdExpenses.details.expense.creator.user', "owner", "categories"]);

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

        $currentMemberDetails = $expenses
            ->where('creator_member_id', $currentMember->id);

        $currentMemberAmount = !$currentMemberDetails->count() ? 0 :  $currentMemberDetails
            ->map(fn ($expense) => $expense->details
                ->where("status", "PENDING")
                ->sum('amount')
            )
            ->sum();

        $otherMembersDetails = $expenses
            ->where('creator_member_id', '!=', $currentMember->id);

        $otherMembersAmount = !$otherMembersDetails->count() ? 0 : $otherMembersDetails
            ->map(fn ($expense) => $expense->details
                ->where("status", "PENDING")
                ->sum('amount')
            )
            ->sum();

        $sold = $currentMemberAmount - $otherMembersAmount;

        $colocation->members = $colocation->members
            ->filter(fn ($member) => $member->user_id != Auth::id() && is_null($member->left_at))
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

    public function leave(Colocation $colocation){
        $member = $colocation->members()->where('user_id', Auth::id())->first();
        $withoutDebts = ($member->debts()->where('status', "PAID")->sum("amount") - $member->debts()->where('status', "PENDING")->sum("amount")) === 0;
        if($withoutDebts){
            Auth::user()->increment("reputation", 1);
        }else{
            Auth::user()->decrement("reputation", 1);
        }

        $member->update([
            "left_at" => now()
        ]);

        return redirect()->route("colocation.index")->with("success","You left the colocation successfully");
    }

    public function members(Colocation $colocation){
        $colocation->load(['members.createdExpenses', "members.user",'members.createdExpenses.creator.user', "owner"]);
        $expenses = $colocation->members
            ->flatMap(fn ($member) => $member->createdExpenses)
            ->sortByDesc('created_at')
            ->values();

        $members = $colocation->members
            ->filter(fn ($member) => is_null($member->left_at))
            ->map(function ($member) use ($expenses) {

                $currentMemberDetails = $expenses
                    ->where('creator_member_id', $member->id);

                $currentMemberAmount = !$currentMemberDetails->count() ? 0 :  $currentMemberDetails
                    ->map(fn ($expense) => $expense->details
                        ->where("status", "PENDING")
                        ->sum('amount')
                    )
                    ->sum();

                $otherMembersDetails = $expenses
                    ->where('creator_member_id', '!=', $member->id);

                $otherMembersAmount = !$otherMembersDetails->count() ? 0 : $otherMembersDetails
                    ->map(fn ($expense) => $expense->details
                        ->where("status", "PENDING")
                        ->sum('amount')
                    )
                    ->sum();

                $member->sold = $currentMemberAmount - $otherMembersAmount;

                return $member;
            })
            ->values();
        return view("colocation.members", compact("members", "colocation"));
    }

    public function removeMember(Colocation $colocation, ColocationMember $colocationMember){
        $owner_id = $colocation->members()->where("role", "Owner")->first()->id;
        $colocationMember->debts()->update([
            'debtor_member_id' => $owner_id
        ]);

        $colocationMember->update([
            "left_at" => now()
        ]);

        return redirect()->route("colocation.show", $colocation)->with("success","Member removed successfully");
    }

    public function markPaid(ExpenseDetail $expenseDetail){

        $expenseDetail->update([
            "status" => "PAID"
        ]);

        return back()->with("success","Expense marked as paid successfully");
    }
}
