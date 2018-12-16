<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CreateTask extends FormRequest
{
    protected $errorBag = 'create';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        

        return [
            'name'=>'required|max:255',
            'project'=>[
                'required',
                'integer',
                // Rule::exists('projects','id')->where(function($query){
                //     return $query->whereIn('id',$this->user()->projects()
                //     ->pluck('id'));  //$query...whereIn 相当于SQL语句
                // })
                Rule::exists('projects','id')->whereIn('id',$this->user()->projects()
                     ->pluck('id')->toArray()) //whereIn 是Rule 方法，需要转换为Array
            ],
            
        ];
    }

    public function  messages()
    {
        return [
            'name.required'=>'任务名称必须填写',
            'name.max'=>'任务名称超出了最大字符限制',
            'project.required'=>'没有提交当前任务所属项目id',
            'project.integer'=>'所提交的项目id无效（非整数）',
            'project.exists'=>'所提交的项目id无效（不存在）',
        ];
    }
}
