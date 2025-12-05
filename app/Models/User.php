<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Enrollment;
use App\Models\Answer;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo', // kolom foto
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    // Accessor Foto Profil
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->photo && Storage::disk('public')->exists('photos/' . $this->photo)) {
            return asset('storage/photos/' . $this->photo);
        }

        $initials = collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->implode('');

        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&background=0D8ABC&color=fff';
    }

    public function chapterResults()
    {
        return $this->hasMany(\App\Models\ChapterResult::class, 'user_id');
    }

}
