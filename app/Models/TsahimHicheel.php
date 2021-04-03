<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TsahimHicheel extends Model
{
    use HasFactory;
    protected $table = 'tsahim_hicheel';

    protected $fillable = [
        'sedev', 
        'tailbar',
        'aguulga',
        'fileUrl',
        'f_id',
        'uzsen'
    ];
}