<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="flex items-center text-xl font-semibold leading-tight text-gray-800">
                <x-bi-github class="w-5 h-5 mr-3 text-gray-600" />
                {{ $pipeline->repository }}
            </h2>
            <form class="flex items-center" action="{{ route('pipeline.destroy', $pipeline) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">
                    <x-heroicon-s-trash class="w-6 h-6 text-red-600" />
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto text-center max-w-7xl sm:px-6 lg:px-8">

            <h2 class="mb-10 text-3xl font-medium text-center text-blue-900">
                You're one step away from greatness
            </h2>

            <p class="mb-6 font-medium">
                The github repository was registered in our system.
            </p>

            <p class="mb-6 font-medium">
                You now need to login with to the twitter account you want to link to this repository.
            </p>

            <div class="p-5 mb-6 space-y-3 border border-blue-800">
                <p>
                    Before you continue, please make sure that you are currently logged in twitter with the correct account.
                </p>
                <p>
                    We will use this account to post your commit tweets.
                </p>
                <p>
                    <a href="https://twitter.com" target="_blank" class="inline-block text-blue-700 hover:text-blue-800 hover:underline">
                        <span class="flex items-center">
                            <x-heroicon-o-external-link class="inline w-4 h-4 mr-1" />
                            <span>Verify in new tab</span>
                        </span>
                    </a>
                </p>
            </div>

            <a href="{{ route('pipeline.twitter.link', $pipeline) }}" class="inline-block px-8 py-3 text-base font-medium text-gray-900 uppercase bg-transparent border-2 border-gray-900 rounded-md hover:bg-gray-900 hover:text-white">
                <span class="flex items-center">
                    <x-bi-twitter class="inline w-5 h-5 mr-4" />
                    Link Twitter Account
                </span>
            </a>
        </div>
    </div>

</x-app-layout>

