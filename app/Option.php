<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    public $table = 'options';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'points',
        'created_at',
        'updated_at',
        'deleted_at',
        'question_id',
        'option_text',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
