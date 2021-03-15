<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irts extends Model
{
    use HasFactory;
    protected $table = 'irts';

    protected $fillable = [
        's_id',
        'day',
        'h_id',
        'status',
        'dun'
    ];
}