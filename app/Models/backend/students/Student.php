<?php

namespace App\Models\backend\students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\Year;
use App\Models\backend\students\Discount;


class Student extends Model
{
  use HasFactory;
  
  protected  $fillable = [
    'student_id','class_id','group_id','year_id','shift_id'
]; 

  public function user()
  {
    return $this->belongsTo(User::class, 'student_id','id');
  }

  public function class()
  {
    return $this->belongsTo(StudentClass::class, 'class_id','id');
  }

  public function year()
  {
    return $this->belongsTo(Year::class, 'year_id','id');
  }

  public function discount()
  {
    return $this->belongsTo(Discount::class, 'year_id','id');
  }
}

