<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_active = User::where("status", "ACTIVE")
            ->orWhere("is_banned", false)->count();

        $total_inactive = User::where("status", "DESACTIVE")
            ->orWhere("is_banned", true)->count();

        $total_users = $total_active + $total_inactive;

        $users = User::orderByDesc("created_at")->get();

        return view('admin.index', compact('users', 'total_users', 'total_active', 'total_inactive'));
    }

    public function ban(User $user){
        $user->update([
            'is_banned' => true,
        ]);

        return back()->with('success','User has been banned successfully');
    }

    public function unban(User $user){
        $user->update([
            'is_banned' => false,
        ]);

        return back()->with('success','User has been unbanned successfully');
    }

    public function activate(User $user){
        $user->update([
            'status' => 'ACTIVE',
        ]);

        return back()->with('success','User has been activated successfully');
    }

    public function deactivate(User $user){
        $user->update([
            'status' => 'DESACTIVE',
        ]);

        return back()->with('success','User has been deactivated successfully');
    }
}
