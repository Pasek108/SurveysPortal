<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Survey extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'owner_id', 'edit_password', 'access_password', 'created_at', 'updated_at'];

    public function owner(): HasOne {
        return $this->HasOne(User::class, 'id', 'owner_id');
    }

    public function tags(): BelongsToMany {
        return $this->BelongsToMany(Tag::class, "surveys_tags", "survey_id", "tag_id");
    }

    public function questions(): HasMany {
        return $this->HasMany(Question::class);
    }

    public function reports(): HasMany {
        return $this->HasMany(Report::class);
    }

    public function ratings(): HasMany {
        return $this->HasMany(Rating::class);
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

    public function getRating($id) {
        $survey = Survey::where("id", $id)->first();
        $ratings = $survey->ratings;

        $avg_rating = 0;
        foreach ($ratings as $rating) $avg_rating += $rating['rating'];
        $avg_rating /= (count($ratings) > 0 ? count($ratings) : 1);

        return number_format((float)round($avg_rating, 2), 2, '.', '');
    }

    public function countRespondents($id) {
        $survey = Survey::where("id", $id)->first();

        $respondents = 0;
        if ($survey->questions[0] ?? false) $respondents = count($survey->questions[0]->userAnswers);

        return $respondents;
    }

    public function countQuestions($id) {
        $survey = Survey::where("id", $id)->first();
        return count($survey->questions);
    }
}
