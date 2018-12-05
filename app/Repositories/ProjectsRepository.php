<?php
/**
 * Created by PhpStorm.
 * User: zhangyang
 * Date: 18/12/2
 * Time: 上午8:38
 */

namespace App\Repositories;

use Image;


class ProjectsRepository{

    public function create($request){
        //$thumb = $request->thumbnail;
        //$name = str_random(40) .'.'. $thumb->extension();
        //dd($name);



        //dd($path);
        //dd($request->thumbnail);

        $request->user()->projects()->create([
            'name' => $request->name,
            'thumbnail'=>$this->thumb($request),]);
    }

    public function thumb($request){
        //return $request->hasFile('thumbnail') ? $request->thumbnail->store('public/thumbs')
        //    : null;
        //}
        if($request->hasFile('thumbnail')){
            $thumb = $request->thumbnail;
            $name = $thumb->hashName();
            $thumb->storeAs('public/thumbs/original',$name);

            $path = storage_path('app/public/thumbs/cropped/'.$name);
            Image::make($thumb)->resize(200, 90)->save($path); //save()不能自动创建文件夹, storeAs()可以自动创建

            return $name;
        }
    }
}