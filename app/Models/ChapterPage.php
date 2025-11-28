<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterPage extends Model
{
    protected $fillable = [
        'chapter_id',
        'page_number',
        'type',
        'video_url',
        'question_text',
        'options',
        'correct_answer',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
