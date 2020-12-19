<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

// 親クラスとしてCreateTaskを継承
class EditTask extends CreateTask
{
    public function rules()
    {
        // CreateTaskのルールを継承
        $rule = parent::rules();

        // 状態の入力値が許可リストに含まれているかRule::inで検証
        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        // 親クラスCreateTaskのattributesメソッドの結果と合体した結果を返却
        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        // 状態のラベル名を取り出し
        $status_labels = array_map(function ($item) {
            return $item['label'];
        }, Task::STATUS);

        // 状態の各ラベル名に句読点をくっつける
        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels . ' のいずれかを指定してください。',
        ];
    }
}
