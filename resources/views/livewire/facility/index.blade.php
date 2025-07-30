<section class="mt-20 lg:mt-24 mb-8 max-w-screen-xl p-4 mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-end">
            <!-- Search -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Cari Fasilitas
                </label>
                <input wire:model.live.debounce.300ms="query" type="text" id="search"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Masukkan nama fasilitas...">
            </div>

            <!-- Sort -->
            <div class="flex-1">
                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Urutkan
                </label>
                <select wire:model.live="sortKey" id="sort"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Pilih urutan</option>
                    <option value="rating">Rating Tertinggi</option>
                    <option value="name">Nama A-Z</option>
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>

            <!-- Rating Filter -->
            <div class="flex-1">
                <label for="minRating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Peringkat Min
                </label>
                <select wire:model.live="minRating" id="minRating"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="maxRating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Peringkat Maks
                </label>
                <select wire:model.live="maxRating" id="maxRating"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Clear Filter Button -->
            <div class="flex items-end">
                <button wire:click="clearFilters" type="button"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Bersihkan
                </button>
            </div>
        </div>

        <!-- Results Info -->
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Menampilkan {{ $this->facilities->count() }} dari {{ $this->facilities->total() }} fasilitas
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-3 gap-4 min-h-200">
        @forelse ($this->facilities as $facility)
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="h-56 w-full">
                    <a href="{{ route('landing.facility.show', $facility->slug) }}">
                        <img class="w-full h-full object-cover dark:hidden"
                            src="{{ $facility->getFirstMediaUrl('carousel') }}" alt="{{ $facility->name }}" />
                    </a>
                </div>
                <div class="pt-6">
                    <a href="{{ route('landing.facility.show', $facility->slug) }}"
                        class="text-lg line-clamp-1 font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $facility->name }}</a>
                    <div class="mt-2 flex items-center gap-2">
                        <p class="text-sm font-medium text-gray-900">Ulasan</p>
                        <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>

                        <p class="text-sm flex gap-1 items-center font-medium text-gray-900 dark:text-white">
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                            {{ number_format($facility->comments->avg('rating'), 1) }}
                        </p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            ({{ count($facility->comments) }})
                        </p>
                    </div>
                    <ul class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1">
                        @foreach ($facility->tags as $tag)
                            <li class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 capitalize">
                                    {{ $tag->name }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center flex items-center">
                <h3 class="text-xl text-gray-600 grow">Fasilitas tidak ditemukan.</h3>
            </div>
        @endforelse
        <div class="col-span-full">
            {{ $this->facilities->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</section>
