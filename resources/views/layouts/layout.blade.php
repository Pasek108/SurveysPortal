<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SurveysPortal - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navbar')

    <div class="relative">
        <canvas id="main-bg" class="fixed top-0 left-0 h-auto 2xl:w-full -z-10 bg-sky-100" width="1536" height="1536"></canvas>
        <div class="fixed top-0 left-0 w-full h-full -z-10 bg-[#0e8aff20]"></div>

        @yield('content')
    </div>

    <footer class="relative z-20 py-4 text-white bg-gray-700">
        <section class="w-full py-4 overflow-hidden even:bg-white">
            <div class="flex flex-col items-center justify-center w-full max-w-screen-xl p-5 mx-auto md:w-5/6 md:flex-row">
                <div class="self-start mb-10 md:w-1/2 md:mb-0 md:mr-10">
                    <h2 class="mb-4 text-2xl font-bold">Links</h2>
                    <p class="text-xl">
                        If you have any problem, questions, or you found a bug, feel free to contact us.
                    </p>
                </div>

                <div class="self-start mb-10 md:w-1/2 md:mb-0">
                    <h2 class="text-2xl font-bold">Any problem? Suggestion? Contact us</h2>

                    <p class="my-4 text-xl">
                        If you have found a bug, encountered any problems, have suggestions, or would like to
                        contact the owner, please feel free to reach out to us.
                    </p>

                    <button class="w-full px-4 py-2 font-semibold text-green-500 bg-transparent border border-green-500 rounded hover:bg-green-700 hover:text-white hover:border-transparent" type="submit">
                        Go to contact page
                    </button>
                </div>
            </div>
        </section>

        <hr class="max-w-screen-xl mx-auto mb-4 border-t border-gray-300">

        <div class="text-lg font-bold text-center">Artur Pas 2023</div>
    </footer>

    <script src="/js/main_bg.js"></script>
</body>
