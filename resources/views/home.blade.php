<x-app-layout>
    <main>
        <div class="container flex flex-col items-center justify-center min-h-screen mx-auto space-y-20">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                Tweet from your commit description
            </h1>

            <div class="relative flex flex-col items-center justify-center">
                <img src="/img/git-commit.png" alt="Git commit example" class="w-4/6" style="width: 70%;">
                <img src="/img/tweet.png" alt="Tweet example" class="w-3/6 mt-10 mr-40" style="max-width: 480px;">
                <img src="/img/arrow-curved.png" alt="arrow" class="absolute w-1/6 right-1/4 top-1/3">
            </div>

            <h2 class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                You don't have to go to twitter to inform your followers about your last update anymore.
            </h2>

            <a href="{{ route(auth()->check() ? 'install' : 'register') }}" class="px-8 py-3 text-base font-medium text-gray-900 uppercase bg-transparent border-2 border-gray-900 rounded-md hover:bg-gray-900 hover:text-white">
                Start now
            </a>
        </div>


        <div class="bg-gradient-to-r from-gray-700 to-blue-800">
            <div class="max-w-2xl px-4 py-16 mx-auto text-center sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Completely free.</span>
                    <span class="block">And <a href="https://github.com/mydnic/gitweet.io" class="underline">open-source</a>.</span>
                </h2>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center w-full px-5 py-3 mt-8 text-base font-medium text-indigo-600 bg-white border border-transparent rounded-md hover:bg-indigo-50 sm:w-auto">
                    Sign up for free
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
