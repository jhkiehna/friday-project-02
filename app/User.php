<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
}
