<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chatroom extends Model
{
    use HasFactory;
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
