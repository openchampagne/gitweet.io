<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pipeline;
use App\Jobs\TweetNewCommit;

class GithubWebHookController extends Controller
{
    public function show(Pipeline $pipeline)
    {
        return $pipeline->count;
    }

    public function store(Pipeline $pipeline)
    {
        dispatch(new TweetNewCommit($pipeline, request()->all()));
    }
}
