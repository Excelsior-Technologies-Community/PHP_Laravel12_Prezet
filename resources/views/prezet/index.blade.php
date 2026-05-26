@php
    /* variables */
@endphp

<x-prezet.template>

    @seo([
        'title' => 'Prezet Blog',
        'description' => 'Laravel Prezet Blog System',
        'url' => route('prezet.index'),
    ])

    <div class="min-h-screen bg-gray-950 py-12">

        <div class="mx-auto max-w-5xl px-5">

            {{-- HEADER --}}
            <div class="mb-12 text-center">

                <h1
                    class="text-5xl font-extrabold tracking-tight text-white"
                >
                    Laravel Blog 🚀
                </h1>

                <p class="mt-4 text-lg text-gray-400">
                    Modern blogging platform built with Laravel 12 + Prezet
                </p>

            </div>


            {{-- SEARCH --}}
            <form
                action="{{ route('search') }}"
                method="GET"
                class="mb-12 flex gap-3 rounded-2xl bg-gray-900 p-4 shadow-lg"
            >

                <input
                    type="text"
                    name="q"
                    placeholder="Search article..."
                    class="w-full rounded-xl border border-gray-700 bg-gray-950 px-5 py-3 text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none"
                >

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700"
                >
                    Search
                </button>

            </form>


            {{-- POSTS --}}
            @foreach ($postsByYear as $year => $posts)

                <h2
                    class="mb-6 text-3xl font-bold text-gray-300"
                >
                    {{ $year }}
                </h2>

                <div class="space-y-8">

                    @foreach ($posts as $post)

                        <x-prezet.article
                            :article="$post"
                            :author="config('prezet.authors.' . $post->frontmatter->author)"
                        />

                    @endforeach

                </div>

            @endforeach


            {{-- PAGINATION --}}
            <div
                class="mt-14 rounded-2xl bg-gray-900 p-5 shadow-lg"
            >

                {{ $paginator->links() }}

            </div>

        </div>

    </div>

</x-prezet.template>