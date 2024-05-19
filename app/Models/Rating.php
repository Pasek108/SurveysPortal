<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'survey_id',
        'rating',
    ];

    public function user(): HasOne {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

}
