<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pipeline extends Model
{
    use GeneratesUuid, HasFactory;

    protected $fillable = [
        'repository',
        'github_webhook_id',
        'twitter_id',
        'twitter_access_code',
        'twitter_access_code_secret',
        'twitter_username',
        'private'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function linkGithubWebhook($webhookId)
    {
        return $this->update([
            'github_webhook_id' => $webhookId
        ]);
    }

    public function linkTwitterAccount($twitterUser)
    {
        return $this->update([
            'twitter_id' => $twitterUser->id,
            'twitter_access_code' => $twitterUser->token,
            'twitter_access_code_secret' => $twitterUser->tokenSecret,
            'twitter_username' => $twitterUser->nickname,
        ]);
    }
}
