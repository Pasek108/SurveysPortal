@props(['label', 'name', 'type', 'placeholder', 'required'])

<div class="mb-3">
    <label class="block mb-1" for="{{ $name }}">{{ $label }}</label>

    <div class="relative z-10 overflow-hidden rounded">
        <input class="px-4 py-1.5 w-full border rounded border-gray-400 text-xl"type="{{ $type }}" id="{{ $name }}"
            name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ old($name) }}"
            {{ !empty($required) ? 'required' : '' }}>

        @if (!empty($required))
            <div class="absolute left-0 top-0 w-12 h-8 bg-red-600
                text-2xl font-bold text-center leading-6 text-black
                rotate-[135deg] -translate-x-[1.35rem] -translate-y-3 pointer-events-none">
                *
            </div>
        @endif
    </div>
</div>
