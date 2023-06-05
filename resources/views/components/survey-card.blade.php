@props(['survey'])

<div class="relative z-0 flex flex-col w-full p-6 bg-white border border-gray-400 rounded-md shadow-md grow md:w-1/3 preserve-3d">
    <a href="/survey/{{ $survey['id'] }}" class="text-white mb-3 w-[calc(100%-3rem)] overflow-hidden text-xl font-bold cursor-pointer whitespace-nowrap text-ellipsis hover:underline">
        {{ $survey['title'] }}
    </a>

    <p class="w-full h-[4.75rem] line-clamp-3 text-ellipsis text-justify overflow-hidden">
        {{ $survey['description'] }}
    </p>

    <div class="flex items-center justify-between mt-2">
        <div>
            {{ $survey->respondents }} respondents
        </div>

        <div>
            {{ $survey->users_ratings }} <i class="fa-solid fa-star text-amber-400"></i>
        </div>
    </div>

    <div class="flex flex-row flex-wrap mt-4">
        @foreach ($survey->tags as $tag)
            <div class="p-0.5 mr-1 mb-1 px-3 rounded-3xl bg-black text-white">{{ $tag['name'] }}</div>
        @endforeach
    </div>

    <div class="absolute origin-bottom-left card-line-back bg-blue-900 top-5 -left-[10px] -z-10 h-9 w-9"></div>
    <div class="absolute top-5 -left-[6px] w-[calc(100%-3rem)] -skew-x-[15deg] bg-blue-600 -z-10 h-9"></div>

</div>
