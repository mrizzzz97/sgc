<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleComment extends Model
{
    protected $fillable = [
        'module_id',
        'user_id',
        'comment',
        'parent_id', // penting untuk reply
    ];

    /**
     * Relasi ke user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Relasi ke module
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Module::class);
    }

    /**
     * Relasi: komentar ini adalah balasan dari komentar lain
     */
    public function parent()
    {
        return $this->belongsTo(ModuleComment::class, 'parent_id');
    }

    /**
     * Relasi: komentar ini punya balasan
     */
    public function replies()
    {
        return $this->hasMany(ModuleComment::class, 'parent_id')
                    ->orderBy('created_at', 'asc');
    }
}
