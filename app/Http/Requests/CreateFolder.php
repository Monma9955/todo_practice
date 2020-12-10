<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 権限チェックはせずリクエストを受け付ける
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
            // name属性がtitleの入力欄の入力は必須
            'title' => 'required|max:20'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'フォルダ名'
        ];
    }
}
