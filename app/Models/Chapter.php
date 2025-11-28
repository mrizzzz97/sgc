<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    protected $table = 'chapters';

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'content',
        'video_url',
        'order',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
    
    public function pages()
    {
        return $this->hasMany(ChapterPage::class);
    }
}
