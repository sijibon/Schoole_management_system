<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamType;

class ExamType extends Model
{
    use HasFactory;

    protected $fillable =[
        'exam_name'
    ];

    public function exam_type()
    {
      return $this->belongsTo(ExamType::class, 'exam_type','id');
    }

}
