<footer class="bg-gray-800" aria-labelledby="footerHeading">
    <h2 id="footerHeading" class="sr-only">Footer</h2>
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:py-16 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex space-x-6 md:order-2">
                <a href="https://twitter.com/mydnic" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">Twitter</span>
                    <x-bi-twitter class="w-6 h-6" />
                </a>

                <a href="https://github.com/mydnic/gitweet.io" target="_blank" class="text-gray-400 hover:text-gray-300">
                    <span class="sr-only">GitHub</span>
                    <x-bi-github class="w-6 h-6" />
                </a>
            </div>
            <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                &copy; {{ date('Y') }} - All rights reserved.
            </p>
        </div>
    </div>
</footer>
