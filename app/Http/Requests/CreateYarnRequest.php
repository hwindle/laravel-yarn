<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateYarnRequest extends FormRequest
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
          /*
          'put_up_id' => 'required',
          'yarn_weight_id' => 'required',
          'notes' => 'nullable',
          'handspun' => 'nullable',
          'fibres_id' => 'required',
          'metres_per_ball' => 'required|digits_between:0,2500',
          'price_gbp' => 'required',
          'ball_weight' => 'required|digits_between:0,1000'
          */
        ];
    }
}
