<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investors extends Model
{
    protected $table='investors';

    protected $guarded=['id'];

    protected $fillable=['phone', 'country', 'email', 'telegram', 'ip', ];

    public $timestamps=true;

}
