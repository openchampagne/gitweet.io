<div>
    <div>
        <x-jet-label for="search" value="{{ __('Search through your repositories') }}" />
        <div class="relative">
            <div class="absolute inset-y-0 flex items-center pl-2">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <x-jet-input
                id="search"
                wire:model="search"
                class="block w-full pl-10 mt-1"
                type="search"
                name="search"
                required
                autofocus
            />
        </div>
    </div>

    <div class="overflow-auto bg-white shadow-sm max-h-80">
        @foreach ($repositories as $repository)
            <a href="{{ url('/pipeline/add/' . $repository['name']) }}" class="flex items-center justify-between p-4 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                    <x-bi-github class="w-4 h-4 text-gray-600" />
                    <span class="font-semibold">{{ $repository['name'] }}</span>
                </div>
                <x-heroicon-o-arrow-sm-right class="w-5 h-5" />
            </a>
        @endforeach
    </div>
</div>
