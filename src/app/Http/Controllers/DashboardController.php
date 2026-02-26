<?php

namespace App\Http\Controllers;

use App\Models\ColocationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $period = request('month-year');

        if ($period) {
            [$year, $month] = explode('-', $period);
        } else {
            $year = now()->year;
            $month = now()->month;
        }

        $expenses = ColocationMember::where("user_id", Auth::user()->id)
            ->with("createdExpenses.category")
            ->get()->flatMap->createdExpenses->filter(fn ($expense) =>
                $expense->created_at->year == $year &&
                $expense->created_at->month == $month
            )
            ->sortByDesc('created_at')
            ->values();
            
        $total_amounts = $expenses->sum("amount");
        return view('dashboard', compact('expenses','total_amounts'));
    }
}
