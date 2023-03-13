<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SurveysPortal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            font-family: 'Hanken Grotesk', sans-serif;
        }

        html {
            font-size: 1.1rem
        }

        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }
    </style>
</head>

<body>
    <nav class="p-4 bg-blue-700 font-bold text-white">
        <div class="flex flex-row justify-center items-center max-w-screen-xl mx-auto">
            <a href="/search" class="px-2">
                <i class="fa-solid fa-magnifying-glass mr-2"></i>
                <span class="hidden md:inline">Search for survey</span>
            </a>

            <div class="absolute logo-container text-center">
                <a href="/" class="text-2xl">
                    <i class="fa-solid fa-check-to-slot"></i>
                    SurveysPortal
                </a>
            </div>

            <ul class="flex grow flex-row justify-end items-center justify-self-end space-x-1">
                <li class="px-2">
                    <a href="/register">
                        <i class="fa-solid fa-user-plus mr-2"></i></i>
                        <span class="hidden md:inline">Register</span>
                    </a>
                </li>
                <li class="px-2">
                    <a href="/login">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>
                        <span class="hidden md:inline">Log in</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div>
            @yield('content')
        </div>
    </main>

    <footer class="p-3 bg-gray-700 text-white">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex md:flex-row flex-col p-5">
                <div class="md:w-1/2 m-2">
                    <h2 class="mb-4 text-2xl font-bold">Links</h2>
                    <p class="text-xl">Below is an example form built entirely with Bootstrap’s form controls. Each
                        required form
                        group has a validation state that can be triggered by attempting to submit the form without
                        completing it.
                    </p>
                </div>

                <div class="md:w-1/2 m-2">
                    <h2 class="mb-4 text-2xl font-bold">Any problem? Suggestion? Contact us</h2>
                    <form class="p-3 border rounded-md border-gray-300">
                        <div class="mb-3">
                            <label class="block mb-1" for="email">Email address</label>
                            <input class="px-3 py-1.5 w-full border rounded-md border-gray-600 text-black"
                                type="email" id="email" placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="block mb-1" for="message">Message</label>
                            <textarea class="h-24 px-3 py-1.5 w-full border rounded-md border-gray-600 text-black" id="message"
                                placeholder="your message text"></textarea>
                        </div>

                        <button
                            class="w-full bg-transparent hover:bg-green-700 text-green-500 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                            type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>

        <hr class="max-w-screen-xl mx-auto mb-2 border-t border-gray-300">
        <div class="font-bold text-center">Artur Pas 2023</div>
    </footer>
</body>

</html>
