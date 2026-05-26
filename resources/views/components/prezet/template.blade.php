<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <x-prezet.meta />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Scripts --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.3.3/src/lite-yt-embed.min.js"
    ></script>

    <script
        defer
        src="https://unpkg.com/@benbjurstrom/alpinejs-zoomable@0.4.0/dist/cdn.min.js"
    ></script>

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.14.1/dist/cdn.min.js"
    ></script>

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"
    ></script>

    @vite(['resources/css/prezet.css'])

    @stack('jsonld')

</head>

<body
    class="min-h-screen bg-[#09090b] font-[Inter] text-gray-200 antialiased"
>

    {{-- BACKGROUND EFFECT --}}
    <div
        class="fixed inset-0 -z-10 bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.15),transparent_35%),radial-gradient(circle_at_bottom,rgba(168,85,247,0.12),transparent_30%)]"
    ></div>

    {{-- HEADER --}}
    <header
        class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur-xl"
    >

        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4"
        >

            {{-- LOGO --}}
            <a
                href="{{ route('prezet.index') }}"
                class="text-2xl font-extrabold tracking-tight text-white"
            >
                Laravel<span class="text-blue-500">Blog</span>
            </a>

            {{-- SEARCH --}}
            <form
                action="{{ route('search') }}"
                method="GET"
                class="hidden md:block"
            >

                <div class="relative">

                    <input
                        type="text"
                        name="q"
                        placeholder="Search article..."
                        class="w-80 rounded-2xl border border-white/10 bg-[#18181b] px-5 py-3 pl-12 text-sm text-white outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                    >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-4 top-3.5 h-5 w-5 text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>

                </div>

            </form>

        </div>

    </header>

    {{-- MAIN CONTENT --}}
    <main class="mx-auto max-w-7xl px-5 py-10">

        {{ $slot }}

    </main>

</body>

</html>