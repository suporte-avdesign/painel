<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Models\Admin\GridProduct as Model;
use AVDPainel\Interfaces\Admin\GridProductInterface;


class GridProductRepository implements GridProductInterface
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

    /**
     * Init Model
     *
     * @return array
     */
    public function get($id)
    {
        $data  = $this->model->where('image_color_id', $id)->get();
        return $data;    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create
     *
     * @param  array $input
     * @param  int $id color
     * @param  int $idpro
     * @param  int $stock
     * @param  int $kit
     * @return array
     */
    public function create($input, $image, $product, $stock, $kit)
    {
        (isset($input['qty_min']) ? $qty_min = $input['qty_min'] : 0);
        (isset($input['qty_max']) ? $qty_max = $input['qty_max'] : 0);

        if ($kit == 1) {

            if ($stock == 1) {
                $grid = [
                    'product_id' => $product->id,
                    'image_color_id' => $image->id,
                    'kit' => $kit,
                    'color' => $image->color,
                    'qty_min' => $qty_min,
                    'qty_max' => $qty_max,
                    'grid' => str_replace('_', '/', $input['grid']),
                    'input' => $input['input'],
                    'output' => 0,
                    'stock' => $input['input']
                ];
                $data = $this->model->create($grid);
                if ($data) {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.str_replace('_', '/', $input['grid']).
                        '- Entrada:'.$input['input'])
                    );
                    return $grid;
                }

            } else {
                $grid = [
                    'product_id' => $product->id,
                    'image_color_id' => $image->id,
                    'kit' => $kit,
                    'color' => $image->color,
                    'qty_min' => $qty_min,
                    'qty_max' => $qty_max,
                    'grid' => str_replace('_', '/', $input['grid']),
                    'input' => 0,
                    'output' => 0,
                    'stock' => 0
                ];
                $data = $this->model->create($grid);
                if ($data) {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.str_replace('_', '/', $input['grid']))
                    );
                }
                return $grid;
            }

        } else {

            foreach ($input as $key => $value) { 
                if ($stock == 1) {
                    $grid = [
                        'product_id' => $product->id,
                        'image_color_id' => $image->id,
                        'kit' => $kit,
                        'color' => $image->color,
                        'qty_min' => $qty_min,
                        'qty_max' => $qty_max,
                        'grid' => str_replace('_', '/', $key),
                        'input' => $value,
                        'output' => 0,
                        'stock' => $value
                    ];

                    $data = $this->model->create($grid);
                    if ($data) {
                        generateAccessesTxt(utf8_decode(
                            '- Grade:'.str_replace('_', '/', $key).
                            '- Entrada:'.$value)
                        );

                        return $grid;
                    }
                } else {
                    $grid = [
                        'product_id' => $product->id,
                        'image_color_id' => $image->id,
                        'kit' => $kit,
                        'color' => $image->color,
                        'qty_min' => $qty_min,
                        'qty_max' => $qty_max,
                        'grid' => str_replace('_', '/', $key),
                        'input' => 0,
                        'output' => 0,
                        'stock' => 0
                    ];
                    $data = $this->model->create($grid);
                    if ($data) {
                        generateAccessesTxt(utf8_decode(
                            '- Grade:'.str_replace('_', '/', $key))
                        );
                        return $grid;
                    }
                }

            }

        }

    }


    public function updateUnit($input, $image, $product, $qty, $des)
    {

    }

    /**
     * Uplodes product kit
     *
     * @param $input
     * @param $image
     * @param $product
     * @param $qty
     * @param $des
     */
    public function updateKit($input, $image, $product, $qty, $des)
    {
        $data   = $this->setId($input['id']);
        $change = '';
        if ($product->stock == 1) {
            $entry = $input['input'];
            if (!empty($entry)) {
                if ($data->input != $entry) {
                    $previousInput = $data->input;
                    $currentInput = $previousInput + $entry;
                    $previousStock = $data->stock;
                    $currentStock = ($previousStock + $entry) - $data->output;
                    $dataForm['input'] = $currentInput;
                    $dataForm['stock'] = $currentStock;
                    $change .= ' Entrada:'.$currentInput.' Estoque:'.$currentStock;
                }
            }
            if ($data->qty_min != $input['qty_min']) {
                $dataForm['qty_min'] = $input['qty_min'];
                $change = ' Qtd Min:'.$input['qty_min'];
            }
            if ($data->qty_max != $input['qty_max']) {
                $dataForm['qty_max'] = $input['qty_max'];
                $change = ' Qtd Max:'.$input['qty_max'];
            }
        }
        $count_qty = count($qty);
        for ($i = 0; $i < $count_qty; $i++) {
            $array[] = array(
                $qty[$i] => $des[$i]
            );
        }
        $str = '';
        foreach ($array as $keys => $values) {
            foreach ($values as $key => $value) {
                $str .= $key . '/' . $value . ',';
            }
        }
        $grid = substr($str, 0, -1);

        if ($data->grid != $grid) {
            $dataForm['grid'] = $grid;
            $change = ' Grid:'.$grid;
        }
        if ($data->color != $image->color) {
            $dataForm['color'] = $input['color'];
            $change .= ' Cor:'.$input['color'];
        }
        if ($change){
            $update = $data->update($dataForm);
            if ($update) {
                generateAccessesTxt($change);
                return $dataForm;
            }
        }
    }

    /**
     * Remove
     *
     * @param  int $id
     * @return boolean true or false
     */
    public function delete($id)
    {

        return false;
    }


    /**
     * Change grids.
     *
     * @param  int $id
     * @param  int $stock
     * @param  int $kit
     */
    public function change($id, $stock, $kit)
    {
        $current = $this->model->where('image_color_id', $id)->get();

        if ($kit == 1) {
            $input=0;
            $output=0;
            foreach ($current as $value) {
                $product_id = $value->product_id;
                $input += $value->input;
                $output += $value->output;
                if ($value->kit == 0) {
                    $grids[] = $value->grid;
                }
            }
            if (isset($grids)) {

                $grid   = implode(",", $grids);
                $total  = $input - $output;
                $delete = $this->model->where('image_color_id', $id)->delete();

                if ($stock == 1) {
                    $update = [
                        'product_id' => $product_id,
                        'image_color_id' => $id,
                        'grid' => $grid,
                        'kit' => $kit,
                        'input' => $input,
                        'output' => $output,
                        'stock' => $total
                    ];
                } else {
                    $update = [
                        'product_id' => $product_id,
                        'image_color_id' => $id,
                        'kit' => $kit,
                        'grid' => $grid
                    ];
                }

                $create = $this->model->create($update);
            }


        } else {
            foreach ($current as $value) {
                if($value->kit == 1) {
                    $product_id = $value->product_id;
                    $grids  = explode(",", $value->grid);
                    $delete = $this->model->where('image_color_id', $id)->delete();
                    foreach ($grids as $key => $val) {
                        $update = [
                            'product_id' => $product_id,
                            'image_color_id' => $id,
                            'kit' => $kit,
                            'grid' => $val,
                            'input' => 0,
                            'output' => 0,
                            'stock' => 0
                        ];

                        $create = $this->model->create($update);
                    }
                }
            }          
        }

        return $this->model->where('image_color_id', $id)->get();
    }





}