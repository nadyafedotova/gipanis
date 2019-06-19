<?php

namespace App\Http\Requests\Api\Reports\Complex;

use Illuminate\Foundation\Http\FormRequest;

class AmazonImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'template_file' => ['required', 'max:1000', 'mimes:txt,text'],
        ];
    }
}
