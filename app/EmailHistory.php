<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    protected $fillable = ['recipient_id', 'prompt'];
}
