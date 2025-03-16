<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('chatroom.store') }}">
                        @csrf
                        <div class="flex flex-col gap-3 flex-shrink-0 flex-grow-0 max-w-2xl">
                            <label for="name">Room name</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm text-black" required>
                            <label for="videoUrl">Video URL</label>
                            <input type="text" name="youtube_video_id" id="videoUrl" class="form-input rounded-md shadow-sm text-black" required>
                            <button type="submit" class="black-btn">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>
