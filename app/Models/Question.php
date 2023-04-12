<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    public function survey(): BelongsTo {
        return $this->BelongsTo(Survey::class);
    }

    public function answers(): HasMany {
        return $this->HasMany(Answer::class);
    }
}
