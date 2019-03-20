<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use App\Task;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        // return $task->steps;
        return response()->json(
            ['steps'=>$task->steps],200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, Request $request)
    {
        $step = $task->steps()->create([
            'name'=>$request->name
        ]);
        // $step->refresh();   //从数据库中返回全部属性，把设置默认值的completion属性也获取

        return response()->json([
            'step'=>$step
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task,Step $step)
    {
        $step->update($request->only('completion'));
        // $step->update([
        //     'completion'=> $request->completion
        // ]);
    }

    public function completeAll(Task $task){
        $task->steps()->update([
            'completion'=>1
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task,Step $step)  //$task占位，避免混淆
    {
        $step->delete();

        return response()->json([
            'msg'=>"当前step删除成功"
        ],204);
    }

    public function clear(Task $task){
        $task->steps()->where('completion',1)->delete();
    }
}
