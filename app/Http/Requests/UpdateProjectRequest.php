<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\Routing\Route;

class UpdateProjectRequest extends FormRequest
{
//    protected $errorBag = 'update';

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
     * $this->route('project')获取当前project id
     */
    public function rules()
    {
        return [
            'name'=>[
              'required',
                Rule::unique('projects')->ignore($this->route('project'))->where(function($query){
                    return $query->where('user_id', $this->user()->id);
                })
            ],
            'thumbnail'=>'image|dimensions:min_width=260,min_height=100|max:2048'
        ];
    }

    public function  messages()
    {
        return [
            'name.required'=>'项目名称必须填写',
            'name.unique'=>'项目名称必须唯一',
            'thumbnail.image'=>'请上传图片文件',
            'thumbnail.dimensions'=>'图片文件最小要求260*100',
            'thumbnail.max'=>'图片文件最大不能超过2M',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errorBag = 'update-'.$this->route('project');
        parent::failedValidation($validator);
}
}
