<div class="mt-16 mb-8">
    @if ($this->periods)
        <div class="fixed top-17 bg-blue-100 w-full z-40">
            <div id="alert-4" class="max-w-screen-xl mx-auto flex items-center p-4 text-sm text-blue-500 rounded-base"
                role="alert">
                <svg class="w-4 h-4 shrink-0 mt-0.5 md:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-2 text-sm ">
                    Kuesioner periode tahun ini telah dibuka. Silahkan segera mengisi kuesioner.
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 focus:ring-warning-medium p-1.5 hover:bg-warning-medium inline-flex items-center justify-center h-8 w-8 shrink-0 cursor-pointer"
                    data-dismiss-target="#alert-4" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            </div>
        </div>
    @else
        <div class="fixed top-17 bg-yellow-100 w-full z-40">
            <div id="alert-4"
                class="max-w-screen-xl mx-auto flex items-center p-4 text-sm text-yellow-500 rounded-base"
                role="alert">
                <svg class="w-4 h-4 shrink-0 mt-0.5 md:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-2 text-sm ">
                    Kuesioner periode tahun ini belum dibuka. Info lebih lanjut silahkan hubungi civitas akademik.
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded focus:ring-2 focus:ring-warning-medium p-1.5 hover:bg-warning-medium inline-flex items-center justify-center h-8 w-8 shrink-0 cursor-pointer"
                    data-dismiss-target="#alert-4" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @livewire('landing.section.hero')
    @livewire('landing.section.available-categories')
    @livewire('landing.section.available-facilities')
</div>
