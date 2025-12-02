<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterCompletion extends Model
{
    protected $fillable = [
        'user_id',
        'chapter_id',
        'completed_at',
    ];

    public $timestamps = true;
}
