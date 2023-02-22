<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectionsValidateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'section_name' => 'required|unique:sections,section_name|min:2|max:30',
            'description' => 'required|min:4',
        ];
    }


    public function messages()
    {
        return  [
            'section_name.required' => 'تاكد من ادخال قيمة ',
            'section_name.unique' => 'هذه القسم موجود بالفعل ',
            'section_name.min' => 'يجب ادخال اسم قسم اكثر من حرفين ',
            'section_name.max' => 'يجب الا يزداد اسم القمسم عن 30 حرف ',
            'description.required' => 'من فضلك ادخل الوصف',
            'description.min' => 'يجب الا يقل الوصف عن 4 احرف علي الاقل',
        ];
    }
}
