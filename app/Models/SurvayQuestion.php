<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurvayQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function survay_options()
    {
        return $this->hasMany(SurvayOption::class, 'survay_question_id', 'id');
    }
}
