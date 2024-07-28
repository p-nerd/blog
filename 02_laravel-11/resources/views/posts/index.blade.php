<x-layout>
    <header class="mx-auto mt-20 max-w-xl text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Laravel From Scratch</span> News
        </h1>
        <div class="mt-4 space-y-2 lg:space-x-4 lg:space-y-0">
            <!--  Category -->
            <div class="relative flex w-32 items-center rounded-xl bg-gray-100 lg:inline-flex">
                <x-dropdown.container>
                    <x-slot name="trigger">
                        <div class="flex appearance-none bg-transparent py-2 pl-3 pr-9 text-left text-sm font-semibold">
                            <button>
                                {{ isset($category) ? ucwords($category->name) : 'Categories' }}
                            </button>
                            <x-icons.down-arrow class="pointer-events-none absolute" style="right: 12px" />
                        </div>
                    </x-slot>
                    <div>
                        <x-dropdown.item href="/" :active="!$category">
                            All
                        </x-dropdown.item>
                        @foreach ($categories as $c)
                            <x-dropdown.item href="?category={{ $c->slug }}" :active="$category?->slug === $c->slug">
                                {{ ucwords($c->name) }}
                            </x-dropdown.item>
                        @endforeach
                    </div>
                </x-dropdown.container>
            </div>
            <!-- Other Filters -->
            <div class="relative flex items-center rounded-xl bg-gray-100 lg:inline-flex">
                <label>
                    <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                        <option value="category" disabled selected>Other Filters</option>
                        <option value="foo">Foo</option>
                        <option value="bar">Bar</option>
                    </select>
                </label>

                <x-icons.down-arrow class="pointer-events-none absolute" style="right: 12px" />
            </div>

            <!-- Search -->
            <div class="relative flex items-center rounded-xl bg-gray-100 px-3 py-2 lg:inline-flex">
                <form method="GET" action="/">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}" />
                    @endif
                    <label>
                        <input type="text" name="search" placeholder="Find something"
                            class="bg-transparent text-sm font-semibold placeholder-gray-500"
                            value="{{ request('search') }}" />
                    </label>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto mt-6 mb-12 max-w-6xl space-y-6 lg:mt-20">
        @if (count($posts) >= 1)
            <x-posts.featured-card :post="$posts[0]" />
        @endif
        <div class="lg:grid lg:grid-cols-2">
            @if (count($posts) >= 2)
                <x-posts.card :post="$posts[1]" />
            @endif
            @if (count($posts) >= 3)
                <x-posts.card :post="$posts[2]" />
            @endif
        </div>
        <div class="lg:grid lg:grid-cols-3">
            @foreach ($posts->skip(3) as $post)
                <x-posts.card :post="$post" />
            @endforeach
        </div>

        {{ $posts->links() }}
    </main>

</x-layout>
