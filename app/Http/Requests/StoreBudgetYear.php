<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetYear extends FormRequest
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
        return [
            "budget_year" => "bail|required|numeric|digits:4|min:".date('Y', strtotime("this year"))."|date_format:Y|unique:budget_years,budget_year",
            "fund_101" => "required|numeric|min:0",
            "fund_164" => "required|numeric|min:0"
            //"is_active" => "required|boolean"
        ];
    }

    public function withValidator($validator){
        $validator->after(function($validator){
            if($validator->fails())
                return redirect("/budget_years")->withErrors($validator);
        });
    }
}
