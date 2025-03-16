<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Chatroom;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chatrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained();
            $table->string('youtube_video_id')->nullable();
            $table->timestamps();
        });

        Chatroom::create([
            'name' => 'room1',
            'user_id' => 1,
            'youtube_video_id' => '7KCzaQdUmyU',
        ]);

        Chatroom::create([
            'name' => 'room2',
            'user_id' => 1,
            'youtube_video_id' => 'aezimBnSJqY',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatrooms');
    }
};
