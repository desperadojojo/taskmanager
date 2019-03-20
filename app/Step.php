<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'name','completion','task_id'
    ];

    protected $attributes = [
        'completion' => false  //告诉laravel 这个属性有默认值，避免出现create不返回相应属性问题，课时39
    ];

    public function task(){
        return $this->belongsTo('App\Task');
    }
}
