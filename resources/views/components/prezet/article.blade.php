@props([
    'article',
    'author',
])

<article
    class="group relative overflow-hidden rounded-3xl border border-white/10 bg-[#111111]/90 p-8 shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:shadow-blue-500/10"
>

    {{-- GLOW EFFECT --}}
    <div
        class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-transparent to-purple-500/5 opacity-0 transition duration-500 group-hover:opacity-100"
    ></div>

    {{-- CATEGORY --}}
    @if ($article->category)

        <div class="relative z-10 mb-5">

            <a
                href="{{ route('prezet.show', ['slug' => strtolower($article->category)]) }}"
                class="inline-flex items-center rounded-full border border-blue-500/30 bg-blue-500/10 px-4 py-1 text-xs font-bold uppercase tracking-widest text-blue-400 transition hover:bg-blue-500/20"
            >
                {{ $article->category }}
            </a>

        </div>

    @endif


    {{-- TITLE --}}
    <h2
        class="relative z-10 text-3xl font-extrabold leading-tight tracking-tight text-white transition group-hover:text-blue-400"
    >

        <a href="{{ route('prezet.show', $article->slug) }}">

            {{ $article->frontmatter->title }}

        </a>

    </h2>


    {{-- EXCERPT --}}
    <p
        class="relative z-10 mt-5 text-[15px] leading-8 text-gray-400"
    >

        {{ $article->frontmatter->excerpt }}

    </p>


    {{-- TAGS --}}
    @if (!empty($article->frontmatter->tags))

        <div class="relative z-10 mt-6 flex flex-wrap gap-2">

            @foreach ($article->frontmatter->tags as $tag)

                <a
                    href="{{ route('prezet.index', ['tag' => strtolower($tag)]) }}"
                    class="rounded-full border border-white/10 bg-[#1a1a1a] px-3 py-1 text-xs font-semibold text-gray-300 transition hover:border-blue-500/30 hover:bg-blue-500/10 hover:text-blue-400"
                >
                    #{{ $tag }}
                </a>

            @endforeach

        </div>

    @endif


    {{-- AUTHOR + BUTTON --}}
    <div
        class="relative z-10 mt-8 flex flex-col gap-5 border-t border-white/10 pt-6 md:flex-row md:items-center md:justify-between"
    >

        {{-- AUTHOR --}}
        <div class="flex items-center gap-4">

            <img
                src="{{ $author['image'] ?? '' }}"
                alt="{{ $author['name'] ?? 'Author' }}"
                class="h-12 w-12 rounded-full border-2 border-blue-500 object-cover shadow-lg"
            >

            <div>

                <h4 class="font-semibold text-white">

                    {{ $author['name'] ?? 'Anonymous' }}

                </h4>

                <div class="mt-1 flex items-center gap-2 text-sm text-gray-500">

                    <x-prezet.icon-calendar class="size-4" />

                    <time datetime="{{ $article->createdAt->toIso8601String() }}">

                        {{ $article->createdAt->format('F j, Y') }}

                    </time>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <a
            href="{{ route('prezet.show', $article->slug) }}"
            class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:scale-105 hover:from-blue-500 hover:to-indigo-500"
        >
            Read Article →
        </a>

    </div>

</article>