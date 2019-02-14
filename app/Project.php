<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $fillable = [
        'name', 'thumbnail'
    ];

    public function author(){
        // $project->user
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function getThumbnailAttribute($value){
        return $value ?? 'guoan.jpg';
    }
    // 属性获取器

}
