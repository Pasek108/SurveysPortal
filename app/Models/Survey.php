<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    public function tags(): BelongsToMany {
        return $this->BelongsToMany(Tag::class, "surveys_tags", "survey_id", "tag_id");
    }

    public function questions(): HasMany {
        return $this->HasMany(Question::class);
    }

    public function scopeFilter($query, array $filters) {
        if (($filters['tag'] ?? false) || ($filters['search'] ?? false)) {
            $query->select()
                ->join('surveys_tags', 'surveys.id', '=', 'surveys_tags.survey_id')
                ->join('tags', 'surveys_tags.tag_id', '=', 'tags.id');
        }

        if ($filters['tag'] ?? false) {
            $query->where('tags.name', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->where('description', 'like', '%' . request('search') . '%');
            //->where('tags.name', 'like', '%' . request('search') . '%');
        }
    }
}
