<?php

namespace AVDPainel\Http\Requests\Admin;

use AVDPainel\Interfaces\Admin\ConfigProductInterface as ConfigProduct;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImages;
use AVDPainel\Interfaces\Admin\ProductInterface as InterProduct;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
{
    public function __construct(
        ConfigProduct $configProduct,
        ConfigImages $configImages,
        InterProduct $interProduct)

    {
        $this->interProduct  = $interProduct;
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
        $img           = $this->request->get('img');
        $product       = $this->interProduct->setId($img['product_id']);

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
            /*
            if ($product->stock == 1) {
                if ($product->kit == 1) {

                    $filter_qty = array_filter($this->request->get('qty'));
                    $unique_des = array_unique($this->request->get('des'));
                    $filter_des = array_filter($unique_des);

                    $count_qty = count($filter_qty);
                    $count_des = count($filter_des);

                    if ($count_qty != $count_des) {

                        $rules['grids.grid'] = 'required';
                    }

                }
            }
            */

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

            $grids = collect($this->request->get('grids'));

            if ( empty($grids) || is_string($grids) ) {
                $rules['grids'] = 'required';
            }

            if ($this->method() == 'POST') {
                if ($configProduct->stock == 1) {

                    if ( !empty($grids) ){

                        if ($configProduct->kit == 1) {
                            foreach ($grids as $key => $value) {
                                if($key == 'grid' && $value == "") {
                                    $rules['grids.grid'] = 'required';
                                }
                                if($key == 'input' && $value == "") {
                                    $rules['grids.input'] = 'required';
                                }
                                if ($product->qty_min == 1) {
                                    if($key == 'qty_min' && $value == "") {
                                        $rules['grids.qty_min'] = 'required';
                                    }
                                }
                                if ($product->qty_max == 1) {
                                    if($key == 'qty_max' && $value == "") {
                                        $rules['grids.qty_max'] = 'required';
                                    }
                                }
                            }
                        } else {

                            foreach ($grids as $key => $value) {

                                if ($key == 'input') {
                                    $filter_key = array_filter($value);
                                    if (empty($filter_key)) {
                                        $rules['input'] = 'required';
                                    }
                                }
                                if ($product->qty_min == 1) {
                                    if ($key == 'qty_min') {
                                        $filter_key = array_filter($value);
                                        if (empty($filter_key)) {
                                            $rules['qty_min'] = 'required';
                                        }
                                    }
                                }
                                if ($key == 'qty_max') {
                                    $filter_key = array_filter($value);
                                    if (empty($filter_key)) {
                                        $rules['qty_max'] = 'required';
                                    }
                                }
                            }

                        }
                    }
                }
            }

        }

        if ($configProduct->group_colors == 1) {
            if ( empty($this->request->get('groups')) ) {
                //dd($this->request->get('groups'));
                $rules['groups'] = 'required';
            }
        }

        return $rules;
     
    }


    public function messages()
    {
        $msg = '';
        $messages = [];
        $messages['qty.required'] = 'A quantidade é obrigatória.';
        $messages['qty_min.required'] = 'A quantidade mínima é obrigatória.';
        $messages['qty_max.required'] = 'A quantidade máxima é obrigatória.';
        $messages['img.product_id.required'] = 'Adicione um produto.';
        $messages['img.code.required'] = 'O código é obrigatório.';
        $messages['img.color.required'] = 'A cor é obrigatória.';
        $messages['img.order.required'] = 'A ordem é obrigatória.';
        $messages['img.html.required'] = 'Clique na imagem para criar a miniatura.';

        $messages['grids.required'] = 'Selecione uma grade';
        $messages['grids.grid.required'] = 'A grade é obrigatória';
        $messages['grids.input.required'] = 'A entrada de estoque é obrigatória.';
        $messages['grids.qty_min.required'] = 'A quantidade mínima é obrigatória.';
        $messages['grids.qty_max.required'] = 'A quantidade máxima é obrigatória.';
        $messages['groups.required'] = 'Selecione no mínimo um grupo de cores.';

        $messages['file.required'] = 'A imagem é obrigatória.';
        $messages['file.image'] = 'Este arquivo é inválido, ';
        $messages['file.mimes'] = 'deverá conter uma imagem do tipo:(jpg,png,gif)';
        $messages['file.dimensions'] = 'largura mínima: '.$this->size->width.' pixels)';

        return $messages;
    }   
}
