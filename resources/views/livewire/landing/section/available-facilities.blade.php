<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Heading & Filters -->
        <div class="mb-4 items-center justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
            <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Fasilitas yang tersedia</h2>
            <a href="{{ route('landing.facility.index') }}" class="text-blue-500 hover:underline transition">Lihat lebih banyak</a>
        </div>
        <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($this->facilities as $facility)
                <div
                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-56 w-full">
                        <a href="{{ route('landing.facility.show', $facility->slug) }}">
                            <img class="object-cover w-full h-full dark:hidden" src="{{ $facility->getFirstMediaUrl('carousel') }}"
                                alt="{{ $facility->name }}" />
                        </a>
                    </div>
                    <div class="pt-6">
                        <a href="{{ route('landing.facility.show', $facility->slug) }}"
                            class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
                            {{ $facility->name }}
                        </a>

                        <ul class="mt-2 flex items-center gap-4">
                            @foreach ($facility->tags as $tag)
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 capitalize">
                                        {{ $tag->name }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
