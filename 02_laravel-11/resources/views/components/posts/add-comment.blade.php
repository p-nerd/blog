@props(['post'])

<form action="{{ route('posts.comments.store', $post) }}" method="POST"
    class="flex flex-col gap-5 rounded-xl border border-gray-200 bg-gray-100 p-6">
    @csrf

    <header class="flex items-center gap-4">
        <img src="https://i.pravatar.cc/60?sig={{ auth()->id() }}" alt="" width="40" height="40"
            class="rounded-full" />
        <h2>Want to participate?</h2>
    </header>

    <div>
        <label for="body">

        </label>
        <textarea name="body" id="body" cols="30" rows="5" class="w-full rounded-xl p-3"
            placeholder="Quick, thing of something to say!" required></textarea>

        @error('body')
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end">
        <button type="submit"
            class="rounded-2xl bg-blue-500 px-10 py-2 text-xs font-semibold uppercase text-white hover:bg-blue-600">
            Comment
        </button>
    </div>
</form>
