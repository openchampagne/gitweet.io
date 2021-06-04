<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\GithubApi;
use Illuminate\Support\Str;

class SearchRepositories extends Component
{
    public $repositories = [];
    public $search;

    public function mount()
    {
        $this->repositories = (new GithubApi)->getAllRepositories(
            auth()->user()
        );
    }

    public function render()
    {
        if ($this->search) {
            $this->repositories = collect($this->repositories)->filter(function ($repo) {
                return Str::contains($repo['name'], $this->search);
            });
        }
        return view('livewire.search-repositories');
    }
}
