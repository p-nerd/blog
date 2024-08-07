@props([
    'comment',
])

<article
    class="flex space-x-4 rounded-xl border border-gray-200 bg-gray-100 p-6"
>
    <div class="flex-shrink-0">
        <img
            src="https://i.pravatar.cc/60?sig={{ $comment->user_id }}"
            alt=""
            width="60"
            height="60"
            class="rounded-xl"
        />
    </div>

    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->user->name }}</h3>
            <p class="text-xs">
                Posted
                <time>{{ $comment->created_at->diffForHumans() }}</time>
            </p>
        </header>
        <p>{{ $comment->body }}</p>
    </div>
</article>
