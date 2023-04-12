<x-layout title="Survey" show_contact="true">
    <div class="flex flex-col grow m-2 md:w-1/3 p-4 border border-gray-400 rounded-md bg-white">
        <h3 class="text-xl font-bold cursor-pointer hover:underline">{{ $survey_data['title'] }}</h3>

        <p class="w-full h-[4.75rem] line-clamp-3 text-ellipsis text-justify overflow-hidden">
            {{ $survey_data['description'] }}</p>

        <p class="text-neutral-500">{{ $survey_data['votes'] }} votes</p>

        <x-survey-tags :tags="$survey_data->tags" />
    </div>
</x-layout>
