<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Github\GithubRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')
            ->scopes(['repo'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userProvider = Socialite::driver('github')->user();

        Auth::login(
            (new GithubRegister)->registerUser($userProvider)
        );

        return redirect()->route('install');
    }
}
