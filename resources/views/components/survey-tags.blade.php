@props(['tags'])

<div class="flex flex-row flex-wrap mt-4">
    @foreach ($tags as $tag)
        <div class="p-0.5 mr-1 mb-1 px-3 rounded-3xl bg-black text-white">{{ $tag['name'] }}</div>
    @endforeach
</div>
