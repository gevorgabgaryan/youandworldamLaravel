<?php

namespace Numerus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoemRequest extends FormRequest
{

      protected function getValidatorInstance()
    {  
        $validator=parent::getValidatorInstance();

        $validator->sometimes('alias_hy', 'unique:poem|max:255', function($input){

                       if($this->route()->hasParameter('adminarticle')){
            $model=$this->route()->parameter('adminarticle');
      
           return ($model->alias != $input->alias) && !empty($input->alias);
            }


          
        });


        return $validator;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDO('ADD_ARTICLES');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */




    public function rules()
    {
     
      
        return [
            'title'=>"required|max:255",
           
        ];
    }

}
