<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function surveys(): BelongsToMany {
        return $this->BelongsToMany(Survey::class, "surveys_tags", "survey_id", "tag_id");
    }
}
