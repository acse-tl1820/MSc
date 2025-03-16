<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Room List') }}
            </h2>

            <a href="/chatroom/create" class="black-btn">create chatroom</a>
        </div>
    </x-slot>

    <div class="py-3">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex gap-4">
                        @foreach($chatrooms as $chatroom)
                            <div class="card">
                                <div>{{$chatroom->name}}</div>
                                <a href="{{route('chatroom.show', $chatroom->id)}}" class="black-btn">join</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
