<section class="bg-white dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 py-8 text-center lg:py-16">
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Bentuk kampus dengan suaramu
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 sm:px-16 lg:px-48 lg:text-xl dark:text-gray-400">
            Jadikan suaramu panduan bagi mahasiswa lain untuk menemukan sudut terbaik kampus, dari ruang diskusi hingga
            tempat bersantai favorit
        </p>
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
            <a href="{{ route('landing.facility') }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Temukan pengalaman
                <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
            <a href="{{ route('login') }}"
                class="flex items-center rounded-lg border border-gray-800 px-5 py-3 text-center text-sm font-medium text-gray-900 hover:bg-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-800">
                Masuk sebagai admin
                <svg class="ms-2 h-6 w-6 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>
