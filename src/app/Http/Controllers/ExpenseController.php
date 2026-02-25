<?php

namespace App\Http\Controllers;

use App\Models\ColocationMember;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function store(Request $request){
        Validator::make($request->all(), [
            'title' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
        ])->validateWithBag('addExpense');

        $expense = Expense::create([
            'title'=> $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'creator_member_id' => ColocationMember::whereHas('user', function ($query) {
                $query->where('user_id', Auth::id());
            })->whereHas('colocation', function ($query) {
                $query->where('status', 'ACTIVE');
            })->first()->id,
        ]);

        $members = ColocationMember::with('colocation.members')
            ->where('user_id', Auth::id())
            ->whereHas("colocation", function ($query) {
                $query->where('status', 'ACTIVE');
            })
            ->first()->colocation->members;

        foreach($members as $member){
            if($member->id != $expense->creator_member_id){
                $expense->details()->create([
                    'debtor_member_id' => $member->id,
                    'amount' => round($expense->amount / $members->count(),2)
                ]);
            }
        }

        return redirect()->back()->with('success','Expense created successfully');
    }

    public function update(Request $request, Expense $expense){
        Validator::make($request->all(), [
            'title' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
        ])->validateWithBag('editExpense');

        $expense->update([
            'title'=> $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
        ]);

        $expense->details()->delete();

        $members = ColocationMember::with('colocation.members')
            ->where('user_id', Auth::id())
            ->whereHas("colocation", function ($query) {
                $query->where('status', 'ACTIVE');
            })
            ->first()->colocation->members;

        foreach($members as $member){
            if($member->id != $expense->creator_member_id){
                $expense->details()->create([
                    'debtor_member_id' => $member->id,
                    'amount' => round($expense->amount / $members->count(),2)
                ]);
            }
        }

        return redirect()->back()->with('success','Expense updated successfully');
    }

    public function destroy(Request $request, Expense $expense){
        $expense->delete();
        return redirect()->back()->with('success','Expense deleted successfully');
    }
}
