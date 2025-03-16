<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('chatroom.{id}', function($user, $chatroom_id){
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('sync.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('change.{id}', function ($user, $id) {
    return true;
});


