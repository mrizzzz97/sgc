<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChapterPageProgress extends Model
{
    protected $table = 'chapter_page_progress';

    protected $fillable = [
        'user_id', 'chapter_id', 'page_id', 'status', 'answer', 'score'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Chapter::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(\App\Models\ChapterPage::class, 'page_id');
    }
}
