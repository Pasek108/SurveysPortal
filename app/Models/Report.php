<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    use HasFactory;

    public function user(): HasOne {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    public function survey(): HasOne {
        return $this->HasOne(Survey::class, 'id', 'survey_id');
    }
}
