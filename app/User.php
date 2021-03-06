<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JournalEntry;

class User extends Model
{
    protected $fillable = ['username, email'];

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }
}
