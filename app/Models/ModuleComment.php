<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleComment extends Model
{
    protected $fillable = ['module_id', 'user_id', 'comment'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Module::class);
    }
}
