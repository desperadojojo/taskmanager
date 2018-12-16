<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;



class UpdateTask extends FormRequest
{
    //protected $errorBag = 'update';
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
        // dd($this->user()->projects()->pluck('id'));
        return [
            'name'=>'required|max:255',
            'project_id'=>[
                'required',
                'integer',
                Rule::exists('projects','id')->where(function($query){
                    return $query->whereIn('id',$this->user()->projects()
                    ->pluck('id'));
                })
            ],
            
        ];
    }

    public function  messages()
    {
        return [
            'name.required'=>'任务名称必须填写',
            'name.max'=>'任务名称超出了最大字符限制',
            'project_id.required'=>'没有提交当前任务所属项目id',
            'project_id.integer'=>'所提交的项目id无效（非整数）',
            'project_id.exists'=>'所提交的项目id无效（当前用户无此项）',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errorBag = 'update-'.$this->route('task');
        parent::failedValidation($validator);
    }
}
