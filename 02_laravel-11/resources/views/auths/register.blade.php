<x-site-layout>
    <main class="mx-auto mt-10 max-w-lg rounded-xl border border-gray-200 bg-gray-100 p-6 px-6 py-8">
        <h1 class="text-center text-xl font-bold">Register!</h1>
        <form method="POST" action="{{ route('register.store') }}" class="mt-10">
            @csrf
            <div class="mb-6">
                <label class="mb-2 block text-xs font-bold uppercase text-gray-700" for="name">
                    Name
                </label>
                <input class="w-full border border-gray-400 p-2" type="text" name="name" id="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="m-t text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="mb-2 block text-xs font-bold uppercase text-gray-700" for="username">
                    Username
                </label>
                <input class="w-full border border-gray-400 p-2" type="text" name="username" id="username"
                    value="{{ old('username') }}" required>
                @error('username')
                    <div class="m-t text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="mb-2 block text-xs font-bold uppercase text-gray-700" for="email">
                    Email
                </label>
                <input class="w-full border border-gray-400 p-2" type="email" name="email" id="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="m-t text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="mb-2 block text-xs font-bold uppercase text-gray-700" for="password">
                    Password
                </label>
                <input class="w-full border border-gray-400 p-2" type="password" name="password" id="password"
                    required>
                @error('password')
                    <div class="m-t text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="mb-2 block text-xs font-bold uppercase text-gray-700" for="password-confirmation">
                    Password Confirmation
                </label>
                <input class="w-full border border-gray-400 p-2" type="password" name="password_confirmation"
                    id="password-confirmation" required>
                @error('password_confirmation')
                    <div class="m-t text-xs text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="rounded bg-blue-400 px-4 py-2 text-white hover:bg-blue-500">
                    Submit
                </button>
            </div>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-xs text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </main>
</x-site-layout>
