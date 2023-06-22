<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    public function types(): HasOne {
        return $this->HasOne(QuestionType::class);
    }

    public function survey(): BelongsTo {
        return $this->BelongsTo(Survey::class);
    }

    public function answers(): HasMany {
        return $this->HasMany(Answer::class);
    }
}
