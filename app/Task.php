<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name','completion','project_id'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function steps(){
        return $this->hasMany('App\Step');
    }
}
