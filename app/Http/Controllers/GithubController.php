<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class GithubController extends Controller
{
    //
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
       
    public function gitCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $user->id)->first();
      
            if ($searchUser) {
                Auth::login($searchUser);
     
                return redirect('/dashboard');
            } else {
                $gitUser = User::create([
                    'name' => $user?->name ?? $user->nickname,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'auth_type'=> 'github',
                    'password' => encrypt('gitpwd059')
                ]);
     
                Auth::login($gitUser);
      
                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
