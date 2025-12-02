<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Chapter;
use App\Models\ChapterCompletion;
use App\Models\Enrollment;
use App\Models\ModuleComment;

class Module extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'order',
    ];

    /**
     * Relasi: Module punya banyak Chapter
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)
            ->orderBy('order');
    }

    /**
     * Relasi: Module punya banyak Enrollment (yang daftar modul)
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi: Semua komentar modul
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ModuleComment::class)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Relasi: Semua completion (progress chapter per modul)
     */
    public function completions(): HasMany
    {
        return $this->hasMany(ChapterCompletion::class);
    }
}
