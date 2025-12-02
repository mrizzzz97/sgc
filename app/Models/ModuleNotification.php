<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'from_user_id',
        'to_user_id',
        'message',
        'read'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
