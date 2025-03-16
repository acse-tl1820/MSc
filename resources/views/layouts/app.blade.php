<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
{{--            @isset($header)--}}
{{--                <header class="bg-white dark:bg-gray-800 shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endisset--}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class="flex justify-between">
                        <div class="text-bold text-lg">create a room</div>
                        <span class="close">&times;</span>
                    </div>
                    <form action="{{route('chatroom.store')}}" method="post" />
                    @csrf
                    <div class="flex flex-col gap-4 p-2" style="width:500px;">


                            <div class="flex flex-col">
                               <x-input-label :value="__('ROOM Name')" />
                               <input type="text" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required/>
                           </div>

                            <div class="flex flex-col">
                               <x-input-label :value="__('Youtube URL')" />
                                <input type="text" name="youtube_video_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required/>
                            </div>

                            <div>
                               <button class="black-btn" type="submit">sumbit</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
