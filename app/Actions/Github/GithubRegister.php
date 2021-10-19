<?php

namespace App\Actions\Github;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GithubRegister
{
    public function registerUser($githubUser)
    {
        $data = $githubUser->user;
        $user = User::where('email', $githubUser->getEmail())->first();

        if (is_null($user)) {
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $data['name'] ?? $data['login'] ?? Str::random(),
                'bio' => $data['bio'],
                'avatar' => $data['avatar_url'],
                'password' => Hash::make(Str::random(10)),
                'github_id' => $data['id'],
                'github_username' => $data['login'],
                'github_access_token' => $githubUser->token,
            ]);
        } else {
            $user->update([
                'name' => $data['name'] ?? $data['login'],
                'bio' => $data['bio'],
                'avatar' => $data['avatar_url'],
            ]);
        }

        return $user;
    }
}
