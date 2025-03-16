<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatRoomController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ChatRoomController::class, 'index'])->name('dashboard');
    Route::get('/chatroom/create', [ChatRoomController::class, 'create'])->name('chatroom.create');
    Route::post('/chatroom', [ChatRoomController::class, 'store'])->name('chatroom.store');
    Route::get('/chatroom/{chatroom}', [ChatRoomController::class, 'show'])->name('chatroom.show');

    Route::get('/chatroom/messages/{chatroom}', [ChatroomController::class, 'chatroomMessages'])->name('chatroom.messages');
    Route::post('/chatroom/sendMessage', [ChatRoomController::class, 'sendMessage'])->name('chatroom.message');
    Route::post('/chatroom/sync-video', [ChatRoomController::class, 'syncVideo'])->name('video.sync');
    Route::post('/chatroom/change-video', [ChatRoomController::class, 'changeVideo'])->name('video.change');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('status/{chatroom}', [ChatRoomController::class, 'checkCurrentStatus'])->name('get.status');
    Route::post('status', [ChatRoomController::class, 'saveCurrentStatus'])->name('post.status');
});

require __DIR__.'/auth.php';
