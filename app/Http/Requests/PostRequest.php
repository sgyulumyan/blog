<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
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
        $rules=[
            'user_id' =>'required',
            'post_name'=>'required|unique:posts',
            'post_body'=>'required',
            
        ];
        

        return $rules;
    }

    public function messages()
    {
        return [
            'post_name.required' => 'An Post Name is required',
            'post_body.required'  => 'An Post Body is required',
            
        ];
    }
}
