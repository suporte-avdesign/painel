<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Models\Admin\ProductCost as Model;
use AVDPainel\Interfaces\Admin\ProductCostInterface;


class ProductCostRepository implements ProductCostInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($input, $product)
    {
        $input['product_id'] = $product->id;

        $data = $this->model->create($input);
        if ($data) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Custo do Produto: '.$product->name.
                    ', Valor:'.setReal($data->value))
            );

        }

        return $data;        
    }


    public function update($input, $product)
    {
        $input['product_id'] = $product->id;

        $data   = $this->model->find($input['id']);
        $update = $data->update($input);

        if ($update) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Alterou Custo do Produto'.$product->name.
                    ' de '.$input['cost'].' para '.setReal($data->value))
            );
        }

        return $update;     
    }


}