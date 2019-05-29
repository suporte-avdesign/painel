<?php

namespace AVDPainel\Http\Requests\Admin;

use AVDPainel\Interfaces\Admin\ConfigProductInterface as ConfigProduct;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImages;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
{
    public function __construct(ConfigProduct $configProduct, ConfigImages $configImages)
    {
        $this->configImages  = $configImages;
        $this->configProduct = $configProduct;
        $this->size          = $this->configImages->setName('default', 'Z');
    }


    /**
     * Determinar se o usuário está autorizado a fazer o request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obter as regras de validação que se aplicam ao request.
     *
     * @return array
     */
    public function rules()
    {

        $configProduct = $this->configProduct->setId(1); 

        /*
        Multiplo uplod
        foreach(range(0, $file) as $index) {
            $rules['file.' . $index] = 'image|mimes:jpeg,gif,png|dimensions:min_width='.$this->size->largura;
        }
        */

        if ($this->method() == 'PUT')
        {
            $file = $this->request->has('file');
            if ($file == 0) {
                $rules['file'] = 'image|mimes:jpeg,gif,png|dimensions:min_width='.$this->size->img_width;
            }

        } else {
            $rules['img.product_id'] = 'required';
            $rules['file'] = 'required|image|mimes:jpeg,gif,png|dimensions:min_width='.$this->size->img_width;
        }

        $rules['img.code']  = 'required';
        $rules['img.color'] = 'required';
        $rules['img.order'] = 'required';
        $rules['img.order'] = 'required|min:0';

        if ($configProduct->mini_colors == 'hexa') {
            $rules['img.html'] = 'required';
        }

        if ($configProduct->grids == 1) { 

            if ( empty($this->request->get('grids')) || is_string($this->request->get('grids')) ) {
                $rules['grids'] = 'required';

            }

            if ($configProduct->stock == 1) { 
                if ( !empty($this->request->get('grids')) ){
                    foreach ($this->request->get('grids') as $key => $value) {
                        if ($value == '') {
                            $rules['stock.'.$key] = 'required';
                        }
                    }
                }
            }

        }

        if ($configProduct->group_colors == 1) {                    
            if ( empty($this->request->get('groups')) ) {
                $rules['groups'] = 'required';
            }

        }

        return $rules;
     
    }


    public function messages()
    {
        $msg = '';
        $messages = [];
        foreach($this->request->get('img') as $key => $val){
            if($key == 'product_id'){
               $msg = "Adicione um produto.";
            }
            if($key == 'code'){
               $msg = "O código é obrigatório.";
            }
            if($key == 'color'){
               $msg = "A cor é obrigatória.";
            }
            if($key == 'order'){
               $msg = "A ordem é obrigatória.";
            }
            if($key == 'html'){
               $msg = "Clique na imagem para criar a miniatura.";
            }
            $messages['img.'.$key.'.required'] = $msg;
        }
        
        if ( !empty($this->request->get('grids')) ){
            foreach ($this->request->get('grids') as $key => $value) {
                if ($value == '') {
                    $messages['stock.'.$key.'.required'] = "A quantidade da grade {$key} é obrigatória.";
                }
            }
        }

        $messages['grids.required'] = 'A grade é obrigatória.';
        $messages['stock.required'] = 'A quantidade   é obrigatória.';
        $messages['groups.required'] = 'Selecione no mínimo um grupo de cores.';

        $messages['file.required'] = 'A imagem é obrigatória.';
        $messages['file.image'] = 'Este arquivo é inválido, ';
        $messages['file.mimes'] = 'deverá conter uma imagem do tipo:(jpg,png,gif)';
        $messages['file.dimensions'] = 'largura mínima: '.$this->size->width.' pixels)';

        return $messages;
    }   
}
