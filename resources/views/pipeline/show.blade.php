@extends('layout')

@section('meta-title', 'Repository ' . $pipeline->repository)

@section('content')
<section class="hero is-medium is-white">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-6 has-text-centered">
                    <h2 class="title is-4">
                        {{ $pipeline->repository }}
                    </h2>
                    <div class="has-background has-text-centered has-content-vcentered w-100 h-100 m-0-auto has-text-twitter" style="background-image: url(/img/gear.png)">
                        <i class="fab fa-twitter fa-2x" style="margin-left: 34%;"></i>
                    </div>
                    <h2 class="title is-4 mt-50">
                        <a href="https://twitter.com/{{ $pipeline->twitter_username }}">{{ '@' . $pipeline->twitter_username }}</a>
                    </h2>
                    <div>
                        <i class="fas fa-check has-text-success"></i>
                        Connected
                    </div>
                    <form action="{{ route('pipeline.destroy', $pipeline) }}" method="post" class="has-text-centered mt-100">
                        @csrf
                        @method('delete')
                        <button class="button is-danger is-outlined is-small">
                            <span class="icon"><i class="fas fa-trash-alt"></i></span>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
