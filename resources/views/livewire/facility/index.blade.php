<section class="mt-28 mb-8 max-w-screen-xl p-4 mx-auto flex flex-col lg:flex-row gap-x-8 gap-y-10">
    <div class="lg:pe-8 lg:border-r border-gray-200 lg:w-4/12">
        <form wire:submit='search' class="w-full">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms='query' type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari fasilitas..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                <svg wire:loading wire:target="query" aria-hidden="true"
                    class="w-5 h-5 absolute right-25 top-[50%] -translate-y-[50%] text-gray-200 animate-spin dark:text-gray-300 fill-primary-800"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
            </div>
        </form>

        <div class="text-lg text-gray-800 font-medium my-6">
            Pilih berdasarkan kategori
        </div>

        <form>
            <div class="flex flex-col gap-4">
                @foreach ($this->tags as $tag)
                    <div class="grid grid-cols-12 items-center gap-2">
                        <input id="{{ $tag->name }}" type="checkbox" value="{{ $tag->name }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <div class="col-span-10">
                            <label for="{{ $tag->name }}"
                                class="text-sm font-medium text-gray-900 dark:text-gray-300 capitalize cursor-pointer">
                                {{ $tag->name }}
                            </label>
                        </div>
                        <span>({{ $tag->facilities_count }})</span>
                    </div>
                @endforeach
            </div>
        </form>

    </div>

    <div class="lg:w-8/12">
        <div class="flex gap-2 justify-end items-center mb-8">
            <label for="filter" class="block text-sm font-medium dark:text-white text-gray-700">Urutkan</label>
            <select wire:model.live='sortKey' id="filter"
                class="w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Pilih urutan</option>
                <option value="name">Nama</option>
                <option value="rating">Bintang</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-3 gap-4 min-h-200">
            @forelse ($this->facilities as $facility)
                <div
                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-56 w-full">
                        <a href="{{ route('landing.facility.show', $facility->slug) }}">
                            <img class="w-full h-full object-cover dark:hidden"
                                src="{{ $facility->getFirstMediaUrl('carousel') }}"
                                alt="{{ $facility->name }}" />
                        </a>
                    </div>
                    <div class="pt-6">
                        <a href="{{ route('landing.facility.show', $facility->slug) }}"
                            class="text-lg line-clamp-1 font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $facility->name }}</a>
                        <div class="mt-2 flex items-center gap-2">
                            <p class="text-sm font-medium text-gray-900">Ulasan</p>
                            <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>

                            <p class="text-sm flex gap-1 items-center font-medium text-gray-900 dark:text-white">
                                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
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
    </div>
</section>
