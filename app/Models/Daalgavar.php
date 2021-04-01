<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daalgavar extends Model
{
    use HasFactory;
    protected $table = 'daalgavar';

    protected $fillable = [
        'ts_id', 
        'end_time',
        'aguulga',
        'fileUrl'
    ];
}
