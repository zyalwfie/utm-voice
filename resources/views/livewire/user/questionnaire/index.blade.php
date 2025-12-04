<div>
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kuesioner Saya</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Lihat dan kelola jawaban kuesioner yang sudah kamu isi
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Jawaban</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ \App\Models\Answer::where('user_id', auth()->id())->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fasilitas Direview</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ $this->facilities->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700 sm:col-span-2 lg:col-span-1">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Jawaban Terakhir</p>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        @php
                            $lastAnswer = \App\Models\Answer::where('user_id', auth()->id())->latest()->first();
                        @endphp
                        {{ $lastAnswer ? $lastAnswer->created_at->diffForHumans() : 'Belum ada' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <!-- Filters -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Search -->
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="query" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Cari jawaban atau pertanyaan...">
                </div>

                <!-- Filter Facility -->
                <div class="flex items-center justify-end gap-3 flex-1">
                    <select wire:model.live="filterFacility"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white min-w-65">
                        <option value="">Semua Fasilitas</option>
                        @foreach ($this->facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Alert -->
        @if (session()->has('success'))
            <div class="p-4">
                <div class="flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900/20 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Answers List -->
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($this->answers as $answer)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                        <!-- Answer Content -->
                        <div class="flex-1 min-w-0">
                            <!-- Facility Badge -->
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $answer->question->facility->name }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $answer->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <!-- Question -->
                            <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">
                                <span class="text-gray-500 dark:text-gray-400">Pertanyaan:</span>
                                {{ $answer->question->content }}
                            </p>

                            <!-- Answer Preview -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2">
                                    {{ $answer->content }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 lg:flex-col lg:items-end">
                            <button wire:click="openViewModal({{ $answer->id }})" type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Lihat
                            </button>
                            <button wire:click="openEditModal({{ $answer->id }})" type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Edit
                            </button>
                            <button wire:click="openDeleteModal({{ $answer->id }})" type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-200 dark:bg-gray-800 dark:text-red-400 dark:border-red-500 dark:hover:bg-red-900/20 dark:focus:ring-red-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada jawaban</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Kamu belum mengisi kuesioner apapun. Mulai dengan mengunjungi halaman fasilitas.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('landing.facility.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Lihat Fasilitas
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($this->answers->hasPages())
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $this->answers->links() }}
            </div>
        @endif
    </div>

    <!-- View Modal -->
    @if ($showViewModal && $this->selectedAnswer)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Detail Jawaban
                        </h3>
                        <button wire:click="closeViewModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Body -->
                    <div class="p-6 space-y-4">
                        <div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                {{ $this->selectedAnswer->question->facility->name }}
                            </span>
                            <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                                {{ $this->selectedAnswer->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Pertanyaan</h4>
                            <p class="text-gray-900 dark:text-white">{{ $this->selectedAnswer->question->content }}</p>
                        </div>

                        <div class="bg-primary-50 dark:bg-primary-900/20 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-primary-700 dark:text-primary-400 mb-2">Jawaban Kamu
                            </h4>
                            <p class="text-gray-900 dark:text-white">{{ $this->selectedAnswer->content }}</p>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex items-center justify-end gap-2 p-4 border-t dark:border-gray-600">
                        <button wire:click="closeViewModal" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Tutup
                        </button>
                        <button wire:click="openEditModal({{ $this->selectedAnswer->id }})" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Edit Jawaban
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
    @if ($showEditModal && $this->selectedAnswer)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Jawaban
                        </h3>
                        <button wire:click="closeEditModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Body -->
                    <div class="p-6 space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Pertanyaan</h4>
                            <p class="text-gray-900 dark:text-white">{{ $this->selectedAnswer->question->content }}</p>
                        </div>

                        <div>
                            <label for="editContent"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jawaban Kamu
                            </label>
                            <textarea wire:model="editContent" id="editContent" rows="5"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Tulis jawaban kamu di sini..."></textarea>
                            @error('editContent')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex items-center justify-end gap-2 p-4 border-t dark:border-gray-600">
                        <button wire:click="closeEditModal" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Batal
                        </button>
                        <button wire:click="updateAnswer" type="button"
                            class="inline-flex items-center py-2.5 px-5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg wire:loading wire:target="updateAnswer" class="w-4 h-4 mr-2 animate-spin"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button wire:click="closeDeleteModal" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">
                        Apakah kamu yakin ingin menghapus jawaban ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="closeDeleteModal" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Tidak, batal
                        </button>
                        <button wire:click="deleteAnswer" type="button"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Ya, hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
