<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinModel extends Model
{
    use HasFactory;

    protected $table = 'ijin';

    protected $fillable = [
        'id',
        'date_from',
        'time_from',
        'date_to',
        'time_to',
        'keterangan',
        'user_id'
    ];
}
