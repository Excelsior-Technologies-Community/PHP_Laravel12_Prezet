<x-prezet.template>

    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-5 dark:text-white">
            Search Results
        </h1>

        <p class="mb-8 text-gray-500">
            Search for:
            <strong>{{ $query }}</strong>
        </p>

        @forelse($results as $post)

            <div class="border rounded p-5 mb-5">

                <h2 class="text-2xl font-bold dark:text-white">

                    {{ $post->frontmatter->title ?? 'No Title' }}

                </h2>

                <a
                    href="/prezet/{{ $post->slug }}"
                    class="text-blue-500 mt-2 inline-block"
                >
                    Read More →
                </a>

            </div>

        @empty

            <p>No results found.</p>

        @endforelse

    </div>

</x-prezet.template>