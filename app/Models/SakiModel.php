<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SakiModel extends Model
{
    use HasFactory;
    protected $table = 'sakit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tanggal',
        'keterangan',
        'user_id',
        'created_at'
    ];
}
