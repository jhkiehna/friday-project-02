<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class JournalEntry extends Model
{
    protected $fillable = ['user_id, content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
