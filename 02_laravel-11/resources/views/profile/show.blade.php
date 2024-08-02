<x-site-layout>
    <main class="mx-auto my-10 flex max-w-6xl flex-col space-y-6">
        <div
            class="flex w-full flex-col items-center space-y-5 border-b pb-10 pt-4"
        >
            @if (true)
                <span
                    class="relative flex h-20 w-20 shrink-0 overflow-hidden rounded-full"
                >
                    <img
                        class="aspect-square h-full w-full"
                        src="https://i.pravatar.cc?sig={{ $user->id }}"
                    />
                </span>
            @endif

            <div class="text-center text-base">
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <a
                    class="underline"
                    href="{{ route('home', ['author' => $user->username]) }}"
                >
                    {{ '@' }}{{ $user->username }}
                </a>
                <p>{{ $user->email }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a
                    href="{{ route('profile.edit') }}"
                    class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                >
                    Edit Profile
                </a>
                <a
                    href="{{ route('profile.posts.create') }}"
                    class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                >
                    New Post
                </a>
            </div>
        </div>
        <h3 class="text-center text-xl font-semibold">
            Your Latest Posts ({{ count($posts) }})
        </h3>
        <div class="flex flex-col space-y-4">
            @foreach ($posts as $post)
                <div
                    class="flex flex-col space-y-3 rounded-lg border p-6 shadow-sm"
                >
                    <div>
                        <a
                            class="text-lg font-medium underline"
                            href="{{ route('home.show', $post) }}"
                        >
                            {{ $post->title }}
                        </a>
                        <div class="text-sm text-gray-800">
                            {!! $post->excerpt !!}
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between space-x-2 text-sm"
                    >
                        <div>
                            <a
                                href="{{ route('profile', ['category' => $post->category->slug]) }}"
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium underline"
                            >
                                {{ $post->category->name }}
                            </a>
                            <a
                                href="{{ route('profile', ['published_on' => urlencode($post->published_at->format('Y-m-d'))]) }}"
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium underline"
                            >
                                {{ $post->published_at->format('d F, Y') }}
                            </a>
                            <p
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium"
                            >
                                {{ $post->published_at->format('h:i:s A') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @php
                                $isPublished = $post->status === \App\Enums\PostStatus::PUBLISHED;
                                $value = $isPublished
                                    ? \App\Enums\PostStatus::DRAFTED->value
                                    : \App\Enums\PostStatus::PUBLISHED->value;
                            @endphp

                            <a
                                href="{{ route('home.show', $post) }}"
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium underline"
                            >
                                View
                            </a>
                            <form
                                action="{{ route('profile.posts.update', $post) }}"
                                method="post"
                            >
                                @csrf
                                @method('patch')
                                <input
                                    type="hidden"
                                    name="status"
                                    value="{{ $value }}"
                                />
                                <button
                                    type="submit"
                                    class="{{ $isPublished ? 'bg-gray-500' : 'bg-green-500' }} inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium text-white"
                                >
                                    {{ $isPublished ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                            <a
                                href="{{ route('profile.posts.edit', $post) }}"
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium underline"
                            >
                                Edit
                            </a>
                            <a
                                href="{{ route('profile.posts.destroy', $post) }}"
                                class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border bg-red-500 px-3 text-sm font-medium text-white"
                            >
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</x-site-layout>
