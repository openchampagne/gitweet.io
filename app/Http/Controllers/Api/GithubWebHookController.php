<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pipeline;
use Abraham\TwitterOAuth\TwitterOAuth;

class GithubWebHookController extends Controller
{
    public function store(Pipeline $pipeline)
    {
        $message = $this->getMessage(request()->input('head_commit.message'));

        if (!empty($message) && $pipeline->twitter_access_code) {
            $pipeline->increment('count');

            $this->tweet($message, $pipeline);
        }
    }

    private function getMessage(string $commitMessage)
    {
        if (($pos = strpos($commitMessage, "\n\n")) !== false) {
            return trim(substr($commitMessage, $pos + 1));
        }

        return null;
    }

    private function tweet(string $message, Pipeline $pipeline)
    {
        $connection = new TwitterOAuth(
            env('TWITTER_CLIENT_ID'),
            env('TWITTER_CLIENT_SECRET'),
            $pipeline->twitter_access_code,
            $pipeline->twitter_access_code_secret
        );

        $connection->post('statuses/update', ['status' => $message]);
    }
}
