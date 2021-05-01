<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'get_mark'
    ];

    public function class()
    {
       return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function subject()
    {
       return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
