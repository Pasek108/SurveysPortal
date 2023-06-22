<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuestionType extends Model
{
    use HasFactory;

    public function survey(): BelongsToMany {
        return $this->BelongsToMany(Question::class);
    }
}
