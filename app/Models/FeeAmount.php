<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeeCategory;
use App\Models\StudentClass;
class FeeAmount extends Model
{
    use HasFactory;
    protected $fillable =[
        'fee_category_id',
        'class_id',
        'amount'
    ];


    public function fee_category()
    {
       return $this->belongsTo(FeeCategory::class, 'fee_category_id','id');
    }

    public function studentClass()
    {
       return $this->belongsTo(StudentClass::class, 'class_id','id');
    }
}
