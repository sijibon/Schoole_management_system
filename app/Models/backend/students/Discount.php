<?php

namespace App\Models\backend\students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

  protected  $fillable = [
        'student_id','fee_category_id','discount'
    ];
}
