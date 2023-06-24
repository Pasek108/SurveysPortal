<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'users_answers';

    public function question(): BelongsTo {
        return $this->belongsTo(Question::class);
    }

    public function user(): HasOne {
        return $this->HasOne(User::class, 'id', 'user_id');
    }
}
