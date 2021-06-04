<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Installed Repositories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @unless ($pipelines->count())
                <div class="p-4 border-l-4 border-yellow-400 bg-yellow-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                You don't have any installed repositories yet.
                                <a href="{{ route('install') }}" class="font-medium text-yellow-700 underline hover:text-yellow-600">
                                    Start now
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endunless

            <ul class="relative z-0 bg-white border-b border-gray-200 divide-y divide-gray-200">
                @foreach ($pipelines as $pipeline)
                    <li class="relative py-5 pl-4 pr-6 hover:bg-gray-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6">
                        <div class="flex items-center justify-between space-x-4">
                            <div class="min-w-0 space-y-3">
                                <div class="flex items-center space-x-3">
                                    @unless ($pipeline->twitter_access_code && $pipeline->github_webhook_id)
                                        <span class="flex items-center justify-center w-4 h-4 bg-red-100 rounded-full" aria-hidden="true">
                                            <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                        </span>
                                    @else
                                        <span class="flex items-center justify-center w-4 h-4 bg-green-100 rounded-full" aria-hidden="true">
                                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                        </span>
                                    @endunless

                                    <span class="block">
                                        <h2 class="text-sm font-medium">
                                            @if (!$pipeline->github_webhook_id)
                                                <a href="/pipeline/add/{{ $pipeline->repository}}">
                                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                                    Webhook is missing
                                                </a>
                                            @endif

                                            @if (!$pipeline->twitter_access_code)
                                                <a href="/pipeline/add/{{ $pipeline->repository}}">
                                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                                    Twitter account is missing
                                                </a>
                                            @endif
                                        </h2>
                                    </span>
                                </div>
                                <a href="https://github.com/{{ $pipeline->repository}}" class="relative group flex items-center space-x-2.5">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99917 0C4.02996 0 0 4.02545 0 8.99143C0 12.9639 2.57853 16.3336 6.15489 17.5225C6.60518 17.6053 6.76927 17.3277 6.76927 17.0892C6.76927 16.8762 6.76153 16.3104 6.75711 15.5603C4.25372 16.1034 3.72553 14.3548 3.72553 14.3548C3.31612 13.316 2.72605 13.0395 2.72605 13.0395C1.9089 12.482 2.78793 12.4931 2.78793 12.4931C3.69127 12.5565 4.16643 13.4198 4.16643 13.4198C4.96921 14.7936 6.27312 14.3968 6.78584 14.1666C6.86761 13.5859 7.10022 13.1896 7.35713 12.965C5.35873 12.7381 3.25756 11.9665 3.25756 8.52116C3.25756 7.53978 3.6084 6.73667 4.18411 6.10854C4.09129 5.88114 3.78244 4.96654 4.27251 3.72904C4.27251 3.72904 5.02778 3.48728 6.74717 4.65082C7.46487 4.45101 8.23506 4.35165 9.00028 4.34779C9.76494 4.35165 10.5346 4.45101 11.2534 4.65082C12.9717 3.48728 13.7258 3.72904 13.7258 3.72904C14.217 4.96654 13.9082 5.88114 13.8159 6.10854C14.3927 6.73667 14.7408 7.53978 14.7408 8.52116C14.7408 11.9753 12.6363 12.7354 10.6318 12.9578C10.9545 13.2355 11.2423 13.7841 11.2423 14.6231C11.2423 15.8247 11.2313 16.7945 11.2313 17.0892C11.2313 17.3299 11.3937 17.6097 11.8501 17.522C15.4237 16.3303 18 12.9628 18 8.99143C18 4.02545 13.97 0 8.99917 0Z" fill="currentcolor"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-500 truncate group-hover:text-gray-900">
                                        {{ $pipeline->repository}}
                                    </span>
                                </a>
                            </div>
                            <div class="sm:hidden">
                                <svg class="w-5 h-5 text-gray-400" x-description="Heroicon name: solid/chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <!-- Repo meta info -->
                            <div class="flex-col items-end flex-shrink-0 hidden space-y-3 sm:flex">
                                <p class="flex items-center space-x-4">
                                    <a href="{{ route('pipeline.show', $pipeline) }}" class="relative text-sm font-medium text-gray-500 hover:text-gray-900">
                                        Check pipeline
                                    </a>
                                </p>
                                <p class="flex space-x-2 text-sm text-gray-500">
                                    @if ($pipeline->github_webhook_id)
                                        <span class="flex items-center">
                                            <x-bi-github class="w-4 h-4 mr-2" />
                                            Github Webhook Id {{ $pipeline->github_webhook_id }}
                                        </span>
                                        <span aria-hidden="true">·</span>
                                    @endif
                                    @if ($pipeline->twitter_access_code)
                                        <span>
                                            <x-bi-twitter class="w-4 h-4 mr-2" />
                                            {{ '@' . $pipeline->twitter_username }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
