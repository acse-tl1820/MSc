<x-app-layout>
    <div class="pt-3">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="flex">
                        <div class="w-full flex flex-col" style="width: 70%;">
                            <div class="dark:bg-gray-800 ml-3">
                                <x-video-player :chatroom="$chatroom"/>
                            </div>
                            <div>
                                <x-change-video />
                            </div>
                        </div>
                        <div class="flex flex-col pb-4 px-2 justify-end border-solid border-gray-200">
                            <x-chat :messages="$messages" :current-user="auth()->user()"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
