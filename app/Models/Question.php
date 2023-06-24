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

    protected $fillable = [
        'question',
        'description',
        'type_id',
    ];

    protected $hidden = ['survey_id', 'created_at', 'updated_at'];

    public function type(): HasOne {
        return $this->HasOne(QuestionType::class, 'id', 'type_id');
    }

    public function survey(): BelongsTo {
        return $this->BelongsTo(Survey::class);
    }

    public function answers(): HasMany {
        return $this->HasMany(Answer::class);
    }

    public function userAnswers(): HasMany {
        return $this->HasMany(UserAnswer::class);
    }
}
