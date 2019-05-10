<?php

namespace App\Http\Requests\Poems;

use Illuminate\Foundation\Http\FormRequest;

class StorePoemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        dump($this->input());

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
            'poem.title' => 'required',
            'poem.author' => 'required',
            'poem.email' => 'required',
            'poem.collection_id' => 'required',
            'poem.text_id' => 'required',
            'poem.json' => 'required',
            'poem.opacity' => 'required',
        ];
    }
}
