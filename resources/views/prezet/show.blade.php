@php

use App\Models\Like;

$authorKey = $document->frontmatter->author ?? null;

$author = $authorKey
? config('prezet.authors.' . $authorKey)
: null;

$totalLikes = Like::where(
    'document_id',
    $document->id
)->count();

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

        {{-- READING TIME + VIEWS --}}
        <div class="flex items-center gap-5 text-sm text-gray-500 mt-2">

            <span>
                ⏱️ {{ readingTime($body) }}
            </span>

            <span>
                👁️ {{ $views }} Views
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
                    name="_token"
                    value="{{ csrf_token() }}">

                <input
                    type="hidden"
                    name="document_id"
                    value="{{ $document->id }}">

                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded">
                    ❤️ Like
                </button>

            </form>

            {{-- TOTAL LIKES --}}
            <p class="mt-3 text-gray-600 dark:text-gray-300">

                Total Likes:
                <strong>{{ $totalLikes }}</strong>

            </p>

        </div>

        {{-- RELATED ARTICLES --}}
        <div class="mt-12">

            <h2 class="text-2xl font-bold mb-4 dark:text-white">
                Related Articles
            </h2>

            @forelse($relatedPosts as $post)

            <div class="border p-4 rounded mb-3 dark:border-gray-700">

                <a
                    href="{{ route('prezet.show', $post->slug) }}"
                    class="font-semibold hover:text-blue-500">

                    {{ $post->frontmatter->title ?? 'Untitled' }}

                </a>

                <p class="text-sm text-gray-500 mt-2">

                    {{ $post->frontmatter->excerpt ?? '' }}

                </p>

            </div>

            @empty

            <p class="text-gray-500">
                No related posts found.
            </p>

            @endforelse

        </div>

    </div>

</x-prezet.template>