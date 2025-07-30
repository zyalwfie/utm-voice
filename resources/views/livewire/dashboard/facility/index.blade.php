@push('head')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush

<main class="p-4 md:ml-64 h-auto pt-20">
    <!-- Start block -->
    <section class="rounded-lg dark:bg-gray-900 antialiased">
        <div class="bg-white dark:bg-gray-800 relative border border-gray-300 sm:rounded-lg">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live='query' type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Cari fasilitas..." required="">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" wire:click="openCreateModal"
                        class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah fasilitas
                    </button>
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Urutkan
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>

                        <div id="filterDropdown"
                            class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Kategori</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                @foreach ($this->tags as $tag)
                                    <li class="flex items-center">
                                        <input id="{{ $tag->name }}" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="{{ $tag->name }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $tag->name }}
                                            ({{ $tag->facilities_count }})
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-4">Nama Fasilitas</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Rating</th>
                            <th scope="col" class="px-4 py-3">Gambar</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Tindakan</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->facilities as $facility)
                            <tr class="border-t border-gray-300">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $facility->name }}
                                </th>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($facility->tags as $tag)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300 capitalize">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $facility->comments_avg_rating ? number_format($facility->comments_avg_rating, 1) : 'Belum ada rating' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-1">
                                        @foreach ($facility->getMedia('carousel')->take(2) as $media)
                                            <img src="{{ $media->getUrl('preview') }}" alt="Carousel"
                                                class="w-8 h-8 rounded object-cover">
                                        @endforeach
                                        @if ($facility->getMedia('carousel')->count() > 2)
                                            <span
                                                class="text-xs text-gray-500">+{{ $facility->getMedia('carousel')->count() - 2 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="{{ $facility->id }}-dropdown-button"
                                        data-dropdown-toggle="{{ $facility->id }}-dropdown"
                                        class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="{{ $facility->id }}-dropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm"
                                            aria-labelledby="{{ $facility->id }}-dropdown-button">
                                            <li>
                                                <button type="button"
                                                    wire:click="openUpdateModal({{ $facility->id }})"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    wire:click="openDeleteModal({{ $facility->id }})"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            fill="currentColor"
                                                            d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    Tidak ada fasilitas yang ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($this->facilities->links())
                <div class="p-4 border-t border-gray-300">
                    {{ $this->facilities->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </section>
    <!-- End block -->

    <!-- Create modal -->
    <div id="createFacilityModal" tabindex="-1" aria-hidden="true"
        @if ($showCreateModal) style="display: flex !important; background-color: rgba(0,0,0,0.5);" @else style="display: none !important;" @endif
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Fasilitas</h3>
                    <button type="button" wire:click="closeCreateModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="facilityName"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" wire:model="facilityName" id="facilityName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ketik nama fasilitas">
                    </div>

                    <div>
                        <label for="tags"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>

                        <select wire:change="addTagToSelection($event.target.value)"
                            class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 capitalize">
                            <option value="">Pilih kategori</option>
                            @foreach ($this->tags as $tag)
                                <option value="{{ $tag->name }}" class="capitalize">{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            @foreach ($selectedTags as $selectedTag)
                                <div
                                    class="text-sm rounded-full px-2 py-1 border border-gray-300 bg-gray-300 text-gray-900 flex items-center gap-1">
                                    <span class="capitalize">{{ $selectedTag }}</span>
                                    <button type="button" wire:click="removeTagFromSelection('{{ $selectedTag }}')"
                                        class="cursor-pointer hover:bg-gray-100 transition rounded-full p-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex gap-2">
                            <input type="text" wire:model="newTagName" placeholder="Tambah tag baru"
                                class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <button type="button" wire:click="createNewTag"
                                class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <div wire:ignore>
                        <label for="carousel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                            Korsel</label>
                        <input class="filepond-carousel" type="file" id="carousel" name="carousel" multiple>
                    </div>

                    <div wire:ignore>
                        <label for="detail"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                            Detail</label>
                        <input class="filepond-detail" type="file" id="detail" name="detail" multiple>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="facilityDescription"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea wire:model="facilityDescription" id="facilityDescription" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tulis deskripsi fasilitas di sini"></textarea>
                    </div>
                </div>

                <button type="button" wire:click="createFacility"
                    class="text-white inline-flex gap-x-2 items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-4 h-4" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah fasilitas baru
                    <div role="status" wire:loading wire:target='createFacility'>
                        <svg aria-hidden="true"
                            class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Update modal -->
    <div id="updateFacilityModal" tabindex="-1" aria-hidden="true"
        @if ($showUpdateModal) style="display: flex !important; background-color: rgba(0,0,0,0.5);" @else style="display: none !important;" @endif
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Fasilitas</h3>
                    <button type="button" wire:click="closeUpdateModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="facilityNameUpdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" wire:model="facilityName" id="facilityNameUpdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ketik nama fasilitas">
                    </div>

                    <div>
                        <label for="tagsUpdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>

                        {{-- Tag selection --}}
                        <select wire:change="addTagToSelection($event.target.value)"
                            class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 capitalize">
                            <option value="">Pilih kategori</option>
                            @foreach ($this->tags as $tag)
                                <option value="{{ $tag->name }}" class="capitalize">{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Display selected tags --}}
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            @foreach ($selectedTags as $selectedTag)
                                <div
                                    class="text-sm rounded-full px-2 py-1 border border-gray-300 bg-gray-300 text-gray-900 flex items-center gap-1">
                                    <span class="capitalize">{{ $selectedTag }}</span>
                                    <button type="button" wire:click="removeTagFromSelection('{{ $selectedTag }}')"
                                        class="cursor-pointer hover:bg-gray-100 transition rounded-full p-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        {{-- Add new tag section --}}
                        <div class="flex gap-2">
                            <input type="text" wire:model="newTagName" placeholder="Tambah tag baru"
                                class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <button type="button" wire:click="createNewTag"
                                class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Show existing images if editing -->
                    @if ($selectedFacilityId)
                        @php
                            $facility = App\Models\Facility::find($selectedFacilityId);
                        @endphp
                        @if ($facility)
                            <div class="sm:col-span-2">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Gambar yang Ada
                                </h4>

                                @if ($facility->getMedia('carousel')->count() > 0)
                                    <div class="mb-3">
                                        <h5 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Carousel</h5>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($facility->getMedia('carousel') as $media)
                                                <div class="relative">
                                                    <img src="{{ $media->getUrl('preview') }}" alt="Carousel"
                                                        class="w-16 h-16 rounded object-cover">
                                                    <button type="button"
                                                        wire:click="deleteMedia({{ $media->id }})"
                                                        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                                        ×
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($facility->getMedia('detail')->count() > 0)
                                    <div class="mb-3">
                                        <h5 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Detail</h5>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($facility->getMedia('detail') as $media)
                                                <div class="relative">
                                                    <img src="{{ $media->getUrl('preview') }}" alt="Detail"
                                                        class="w-16 h-16 rounded object-cover">
                                                    <button type="button"
                                                        wire:click="deleteMedia({{ $media->id }})"
                                                        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                                        ×
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif

                    {{-- FilePond inputs for new images --}}
                    <div wire:ignore>
                        <label for="carouselUpdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Gambar
                            Korsel</label>
                        <input class="filepond-carousel-update" type="file" id="carouselUpdate"
                            name="carouselUpdate" multiple>
                    </div>

                    <div wire:ignore>
                        <label for="detailUpdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Gambar
                            Detail</label>
                        <input class="filepond-detail-update" type="file" id="detailUpdate" name="detailUpdate"
                            multiple>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="facilityDescriptionUpdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea wire:model="facilityDescription" id="facilityDescriptionUpdate" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tulis deskripsi fasilitas di sini"></textarea>
                    </div>
                </div>

                <button type="button" wire:click="updateFacility"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                    </svg>
                    Perbarui fasilitas
                </button>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        @if ($showDeleteModal) style="display: flex !important; background-color: rgba(0,0,0,0.5);" @else style="display: none !important;" @endif
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button" wire:click="closeDeleteModal"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus fasilitas ini?
                </p>
                <div class="flex justify-center items-center space-x-4">
                    <button wire:click="closeDeleteModal" type="button"
                        class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Tidak, batal
                    </button>
                    <button type="button" wire:click="deleteFacility"
                        class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Ya, hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@push('foot')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType
        );

        let pondCarousel, pondDetail, pondCarouselUpdate, pondDetailUpdate;

        function initializeFilePond() {
            const carouselInput = document.querySelector('.filepond-carousel');
            if (carouselInput && !pondCarousel) {
                pondCarousel = FilePond.create(carouselInput, {
                    allowMultiple: true,
                    maxFiles: 5,
                    acceptedFileTypes: ['image/*'],
                    server: {
                        process: {
                            url: '{{ route('upload.carousel') }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleCarouselUpload', response);
                                return response;
                            },
                            onerror: (response) => {
                                console.error('Upload error:', response);
                            }
                        },
                        revert: {
                            url: '{{ url('/upload/delete') }}/',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleFileRemoval', response, 'carousel');
                            }
                        }
                    },
                    labelIdle: 'Seret & jatuhkan gambar korsel atau <span class="filepond--label-action">Browse</span>',
                });
            }

            const detailInput = document.querySelector('.filepond-detail');
            if (detailInput && !pondDetail) {
                pondDetail = FilePond.create(detailInput, {
                    allowMultiple: true,
                    maxFiles: 10,
                    acceptedFileTypes: ['image/*'],
                    server: {
                        process: {
                            url: '{{ route('upload.detail') }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleDetailUpload', response);
                                return response;
                            },
                            onerror: (response) => {
                                console.error('Upload error:', response);
                            }
                        },
                        revert: {
                            url: '{{ url('/upload/delete') }}/',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleFileRemoval', response, 'detail');
                            }
                        }
                    },
                    labelIdle: 'Drag & Drop gambar detail atau <span class="filepond--label-action">Browse</span>',
                });
            }

            const carouselUpdateInput = document.querySelector('.filepond-carousel-update');
            if (carouselUpdateInput && !pondCarouselUpdate) {
                pondCarouselUpdate = FilePond.create(carouselUpdateInput, {
                    allowMultiple: true,
                    maxFiles: 5,
                    acceptedFileTypes: ['image/*'],
                    server: {
                        process: {
                            url: '{{ route('upload.carousel') }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleCarouselUpload', response);
                                return response;
                            },
                            onerror: (response) => {
                                console.error('Upload error:', response);
                            }
                        },
                        revert: {
                            url: '/upload/delete',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleFileRemoval', response, 'carousel');
                            }
                        }
                    },
                    labelIdle: 'Seret & jatuhkan gambar korsel tambahan atau <span class="filepond--label-action">Browse</span>',
                });
            }

            const detailUpdateInput = document.querySelector('.filepond-detail-update');
            if (detailUpdateInput && !pondDetailUpdate) {
                pondDetailUpdate = FilePond.create(detailUpdateInput, {
                    allowMultiple: true,
                    maxFiles: 10,
                    acceptedFileTypes: ['image/*'],
                    server: {
                        process: {
                            url: '{{ route('upload.detail') }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleDetailUpload', response);
                                return response;
                            },
                            onerror: (response) => {
                                console.error('Upload error:', response);
                            }
                        },
                        revert: {
                            url: '{{ url('/upload/delete') }}/',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                @this.call('handleFileRemoval', response, 'detail');
                            }
                        }
                    },
                    labelIdle: 'Drag & Drop gambar detail tambahan atau <span class="filepond--label-action">Browse</span>',
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeFilePond();
        });

        document.addEventListener('livewire:navigated', function() {
            setTimeout(() => {
                initializeFilePond();
            }, 100);
        });

        Livewire.on('modal-closed', (modalId) => {
            if (modalId === 'createFacilityModal') {
                if (pondCarousel) pondCarousel.removeFiles();
                if (pondDetail) pondDetail.removeFiles();
            }
            if (modalId === 'updateFacilityModal') {
                if (pondCarouselUpdate) pondCarouselUpdate.removeFiles();
                if (pondDetailUpdate) pondDetailUpdate.removeFiles();
            }
        });

        Livewire.on('facility-created', () => {
            if (pondCarousel) pondCarousel.removeFiles();
            if (pondDetail) pondDetail.removeFiles();
        });
    </script>
@endpush
