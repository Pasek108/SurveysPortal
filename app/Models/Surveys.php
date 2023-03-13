<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Surveys extends Model
{
    use HasFactory;

    public function tags(): BelongsToMany {
        return $this->BelongsToMany(Tags::class, "surveys_tags", "survey_id", "tag_id");
    }
}
