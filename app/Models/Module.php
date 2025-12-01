<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'order',
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(\App\Models\Chapter::class)->orderBy('order');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(\App\Models\Enrollment::class);
    }
    public function comments()
    {
        return $this->hasMany(\App\Models\ModuleComment::class)->orderBy('created_at', 'desc');
    }

}
