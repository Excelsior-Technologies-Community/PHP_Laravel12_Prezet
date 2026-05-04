@php
    /* @var string $body */
    /* @var array $nav */
    /* @var array $headings */
    /* @var string $linkedData */
    /* @var \Prezet\Prezet\Data\DocumentData $document */
@endphp

@php
    $authorKey = $document->frontmatter->author ?? null;
@endphp

@php
    $author = $authorKey ? config('prezet.authors.' . $authorKey) : null;
@endphp

<x-prezet.template>

    @seo([
        'title' => $document->frontmatter->title ?? 'Untitled',
        'description' => $document->frontmatter->excerpt ?? '',
        'url' => route('prezet.show', ['slug' => $document->slug]),
        'image' => $document->frontmatter->image ?? asset('default.png'),
    ])

    @push('jsonld')
        <script type="application/ld+json">
            {!! $linkedData !!}
        </script>
    @endpush

    <x-prezet.alpine>
        <div class="grid grid-cols-12 gap-8">

            {{-- HEADER --}}
            <div class="col-span-12 xl:col-span-10 xl:col-start-2 2xl:col-span-6 2xl:col-start-4">

                <li class="flex items-center dark:text-white">
                    @if(!empty($document->category))
                        <a href="#">
                            {{ $document->category }}
                        </a>
                    @endif
                </li>

                <h1 class="mb-6 text-3xl font-bold dark:text-white">
                    {{ $document->frontmatter->title ?? 'No Title' }}
                </h1>

                {{-- AUTHOR --}}
                <ul class="flex flex-wrap items-center gap-3 font-medium">

                    <li class="w-full sm:w-auto dark:text-white">
                        <a href="#author" class="flex items-center gap-x-2">

                            <img
                                src="{{ $author['image'] ?? asset('default.png') }}"
                                alt="{{ $author['name'] ?? 'Author' }}"
                                width="26"
                                height="26"
                                class="h-[26px] w-[26px] rounded object-cover"
                            />

                            <span>
                                {{ $author['name'] ?? 'Unknown Author' }}
                            </span>

                        </a>
                    </li>

                    <li class="hidden sm:inline-block text-gray-500">—</li>

                    <li class="flex items-center gap-1 text-gray-500">
                        <span>
                            {{ $document->frontmatter->date ?? date('Y-m-d') }}
                        </span>
                    </li>

                </ul>
            </div>

            {{-- LINE --}}
            <div class="col-span-12 xl:col-span-10 xl:col-start-2 2xl:col-span-8 2xl:col-start-4">
                <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="col-span-12 lg:col-span-9">

                <article class="prose max-w-none dark:prose-invert">
                    {!! $body !!}
                </article>

                {{-- TAGS --}}
                @if(!empty($document->frontmatter->tags))
                    <div class="mt-10 border-t pt-6">
                        <ul class="flex flex-wrap gap-2">

                            @foreach($document->frontmatter->tags as $tag)
                                <li>
                                    <a href="#"
                                       class="px-3 py-1 text-xs bg-gray-100 rounded">
                                        {{ $tag }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endif

                {{-- AUTHOR BOX --}}
                <div id="author"
                     class="mt-10 flex flex-col md:flex-row gap-6 p-6 bg-gray-50 dark:bg-gray-800 rounded">

                    <img
                        src="{{ $author['image'] ?? asset('default.png') }}"
                        class="w-24 h-24 rounded object-cover"
                    />

                    <div>

                        <h3 class="text-xl font-semibold">
                            {{ $author['name'] ?? 'Unknown Author' }}
                        </h3>

                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            {{ $author['bio'] ?? 'No bio available' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </x-prezet.alpine>

</x-prezet.template>