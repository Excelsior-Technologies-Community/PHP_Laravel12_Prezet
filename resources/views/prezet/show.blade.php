@php

    use App\Models\Like;

    $authorKey = $document->frontmatter->author ?? null;

    $author = $authorKey
        ? config('prezet.authors.' . $authorKey)
        : null;

    $totalLikes = Like::where('document_id', $document->id)->count();

@endphp

<x-prezet.template>

    @seo([
        'title' => $document->frontmatter->title ?? 'Untitled',
        'description' => $document->frontmatter->excerpt ?? '',
        'url' => route('prezet.show', ['slug' => $document->slug]),
        'image' => $document->frontmatter->image ?? asset('default.png'),
    ])

    <div class="max-w-3xl mx-auto py-10">

        {{-- TITLE --}}
        <h1 class="text-3xl font-bold dark:text-white">
            {{ $document->frontmatter->title ?? '' }}
        </h1>

        {{-- AUTHOR + DATE --}}
        <div class="flex items-center gap-3 mt-2 text-gray-500">

            <span>
                {{ $author['name'] ?? 'Unknown Author' }}
            </span>

            <span>•</span>

            <span>
                {{ $document->frontmatter->date ?? date('Y-m-d') }}
            </span>

        </div>

        {{-- CONTENT --}}
        <article class="prose dark:prose-invert mt-6 max-w-none">
            {!! $body !!}
        </article>

        {{-- TAGS --}}
        @if(!empty($document->frontmatter->tags))

            <div class="mt-6 flex flex-wrap gap-2">

                @foreach($document->frontmatter->tags as $tag)

                    <span class="bg-gray-200 dark:bg-gray-700 px-3 py-1 text-xs rounded">

                        {{ $tag }}

                    </span>

                @endforeach

            </div>

        @endif

        {{-- LIKE BUTTON --}}
        <div class="mt-10">

            <form action="{{ route('like.store') }}" method="POST">

                @csrf

                <input
                    type="hidden"
                    name="document_id"
                    value="{{ $document->id }}"
                >

                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded"
                >
                    ❤️ Like
                </button>

            </form>

            {{-- TOTAL LIKES --}}
            <p class="mt-3 text-gray-600 dark:text-gray-300">

                Total Likes:
                <strong>{{ $totalLikes }}</strong>

            </p>

        </div>

        {{-- AUTHOR BOX --}}
        <div class="mt-10 p-5 bg-gray-100 dark:bg-gray-800 rounded">

            <h3 class="font-bold text-lg dark:text-white">

                {{ $author['name'] ?? 'Author' }}

            </h3>

            <p class="text-gray-600 dark:text-gray-300 mt-2">

                {{ $author['bio'] ?? 'No bio available' }}

            </p>

        </div>

    </div>

</x-prezet.template>