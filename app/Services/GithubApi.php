<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Pipeline;
use GuzzleHttp\Exception\ClientException;

class GithubApi
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.github.com']);
    }

    public function getPublicRepositories(User $user)
    {
        $request = $this->client->request('get', '/users/' . $user->github_username . '/repos?per_page=100', [
            'query' => [
                'access_token' => $user->github_access_token,
            ],
        ]);

        $repositories = collect(json_decode($request->getBody(), true));

        return $repositories->map(function ($repo) {
            return [
                'name' => $repo['full_name'],
                'private' => false,
            ];
        });
    }

    public function getPrivateRepositories(User $user)
    {
        $repositories = $this->getRepositoriesWithPrivate($user);

        return $repositories->where('private', true)->map(function ($repo) {
            return [
                'name' => $repo['full_name'],
                'private' => true,
            ];
        });
    }

    public function getAllRepositories(User $user)
    {
        $repositories = $this->getRepositoriesWithPrivate($user);

        return $repositories->map(function ($repo) {
            return [
                'name' => $repo['full_name'],
                'private' => true,
            ];
        });
    }

    private function getRepositoriesWithPrivate(User $user)
    {
        $request = $this->client->request('get', '/user/repos?per_page=100', [
            'headers' => ['Authorization' => 'Bearer ' . $user->github_access_token]
        ]);

        return collect(json_decode($request->getBody(), true));
    }

    public function addWebhook(User $user, $repository, Pipeline $pipeline)
    {
        if ($pipeline->github_webhook_id) {
            return $pipeline->github_webhook_id;
        }

        try {
            $request = $this->client->request('post', '/repos/' . $repository . '/hooks', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $user->github_access_token,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'name' => 'web',
                    'config' => [
                        'url' => 'https://gitweet.io/api/webhook/' . $pipeline->uuid,
                        'content_type' => 'json'
                    ],
                ]
            ]);

            $webhook = json_decode($request->getBody(), true);
            $pipeline->linkGithubWebhook($webhook['id']);

            return $webhook;
        } catch (ClientException $e) {
            $this->returnWithError($e->getResponse()->getBody()->getContents());
        }
    }

    public function deleteWebhook(User $user, $repository, Pipeline $pipeline)
    {
        try {
            $request = $this->client->request('delete', '/repos/' . $repository . '/hooks/' . $pipeline->github_webhook_id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $user->github_access_token,
                    'Content-Type' => 'application/json'
                ],
            ]);

            return json_decode($request->getBody(), true);
        } catch (ClientException $e) {
            if ($e->getCode() === 404) { // the hook was probably removed manually, so let's skip
                // code...
            } else {
                $this->returnWithError($e->getResponse()->getBody()->getContents());
            }
        }
    }

    private function returnWithError(string $message)
    {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', 'danger');

        abort(redirect()->route('pipeline.index'));
    }
}
