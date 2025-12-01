<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChapterResult extends Model
{
    use HasFactory;

    // Nama tabel (opsional tapi aman untuk kepastian)
    protected $table = 'chapter_results';

    // Field yang boleh diisi
    protected $fillable = [
        'user_id',
        'chapter_id',
        'score',
        'correct',
        'total',
        'passed'
    ];

    // Casting otomatis
    protected $casts = [
        'passed' => 'boolean',
        'score'  => 'integer',
        'correct' => 'integer',
        'total' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(\App\Models\Chapter::class);
    }
}
