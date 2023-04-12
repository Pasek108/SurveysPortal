@php
    $notifications = [
        'messages' => 0,
        'reports' => 23,
        'contact' => 167,
    ];
@endphp

<x-layout title="Admin dashboard" show_contact="false">
    <section class="w-full">
        <div class="relative flex flex-col md:flex-row items-start max-w-screen-xl mx-auto">
            <div class="sticky top-0 z-10 w-60 md:w-1/3 lg:w-1/4">
                <x-admin-nav active_page="dashboard" :notifications="$notifications" />
            </div>
            <div class="flex flex-col w-full md:w-2/3 lg:w-3/4 min-h p-5">
                <h2 class="text-3xl font-bold">Welcome {{ 'Artur' }}!</h2>

                <div class="min-h-screen">
                    <h3>Announcements</h3>
                    <div>Empty</div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
