<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Pipeline;

class TwitterController extends Controller
{
    public function redirectToProvider(Pipeline $pipeline)
    {
        session()->put(['pipeline' => $pipeline->uuid]);

        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $pipeline = Pipeline::where('uuid', session('pipeline'))->first();

        $pipeline->linkTwitterAccount($user);

        return redirect()->route('pipeline.index');
    }
}
