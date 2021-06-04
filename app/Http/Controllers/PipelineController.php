<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use App\Services\GithubApi;

class PipelineController extends Controller
{
    public function index()
    {
        $pipelines = auth()->user()->pipelines;

        return view('pipeline.index', compact('pipelines'));
    }

    public function show(Pipeline $pipeline)
    {
        if (!$pipeline->twitter_access_code) {
            return view('pipeline.twitter.link', compact('pipeline'));
        }
        return view('pipeline.show', compact('pipeline'));
    }

    public function addRepository($author, $repository, GithubApi $github)
    {
        $user = auth()->user();
        $repository = $author . '/' . $repository;

        // Get Pipeline model
        $pipeline = Pipeline::where('repository', $repository)->first();

        if ($pipeline) {
            $this->authorize('view', $pipeline);
            $github->addWebhook($user, $repository, $pipeline);
        } else {
            // Collect User Repositories
            $repositories = $github->getAllRepositories($user);

            // 403 if incorrect repository or url
            if (!$repositories->contains('name', $repository)) {
                abort(403, 'Unauthorized.');
            }

            // If it's a new pipeline, save it and install the webhook
            $user->pipelines()->save($pipeline = new Pipeline([
                'repository' => $repository,
                'private' => $repositories->where('name', $repository)->first()['private']
            ]));

            $github->addWebhook($user, $repository, $pipeline);
        }

        return view('pipeline.twitter.link', compact('pipeline'));
    }

    public function destroy(Pipeline $pipeline)
    {
        $pipeline->delete();

        session()->flash('flash.banner', 'The repositroy was unlinked, and the pipeline was deleted');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pipeline.index');
    }
}
