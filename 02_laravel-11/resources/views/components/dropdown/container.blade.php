@props(['trigger'])

<div x-data="{ show: false }">
    <div @click="show = !show" @click.away="show = false">
        {{ $trigger }}
    </div>

    <div x-show="show" class="absolute z-50 mt-2 max-h-52 w-full overflow-auto rounded-xl bg-gray-100 py-2"
        style="display: none">
        {{ $slot }}
    </div>
</div>
