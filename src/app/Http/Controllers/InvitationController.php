<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\InvitationToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvitationController extends Controller
{

    public function invalid(){
        return view("invite.invalid");
    }

    public function accept(int $colocationId){
        return view("invite.accept", compact("colocationId"));
    }

    public function reject(){
        return view("invite.reject");
    }

    public function conflict(){
        return view("invite.conflict");
    }

    public function success( int $colocationId){
        return view("invite.success", compact("colocationId"));
    }

    public function invite(Request $request, int $colocationId){

        Validator::make($request->all(), [
            'email' => 'required|email',
        ])->validateWithBag('addInvitation');

        InvitationToken::create([
            'email' => $request->email,
            'token'=> Str::random(64),
            'expires_at' => now()->addMinutes(10),
            'colocation_id' => $colocationId,
        ]);

        return redirect()->route('colocation.show', $colocationId)->with('success','Invitation sent successfully');
    }

    public function validateToken(string $tokenValue)
    {
        $token = InvitationToken::where('token', $tokenValue)
            ->valid()
            ->first();

        if (! $token) {
            return redirect()->route('invite.invalid');
        }

        $user = User::where('email', $token->email)->first();

        if (! $user) {
            session(['invitation_token' => $tokenValue, "email" => $token->email]);
            return redirect()->route('register');
        }
        if (! Auth::check()) {
            session(['invitation_token' => $tokenValue, 'email'=> $token->email]);
            return redirect()->route('login.view');
        }

        session()->forget(['invitation_token', 'email']);

        $token->markAsUsed();

        return redirect()->route('invite.accept', ['colocationId' => $token->colocation_id]);
    }

    public function confirm(Request $request, int $colocationId){
        $activeCount = Colocation::active()->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id())
                ->whereNull('left_at');
        })->count();

        if($activeCount > 0){
            return redirect()->route("invite.conflict");
        }

        $colocation = Colocation::find($colocationId);
        $member = $colocation->members()->where("user_id", Auth::id())->first();
        if ($member) {
            $member->update([
                "left_at" => null
            ]);
        }else{
            $colocation->members()->create([
                "user_id" => Auth::id(),
                "role" => "Member"
            ]);
        }

        return redirect()->route("invite.success", $colocationId)->with("success","You joined the colocation successfully");
    }

    public function refuse(Request $request){
        session()->forget('invitation_token');
        return redirect()->route("invite.reject");
    }

}
