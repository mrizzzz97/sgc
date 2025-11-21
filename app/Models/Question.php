<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = ['chapter_id', 'question_text', 'type', 'choices', 'correct_answer', 'points', 'order'];
    protected $casts = ['choices' => 'json'];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
