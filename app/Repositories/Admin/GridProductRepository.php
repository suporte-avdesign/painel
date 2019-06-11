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
     * Date: 04/06/2019
     *
     * @param $id
     * @return mixed
     */
    public function getUnit($id)
    {
        $data  = $this->model->where('image_color_id', $id)->get();
        return $data;    
    }

    /**
     * Date: 04/06/2019
     *
     * @param $id
     * @return mixed
     */
    public function getKit($id)
    {
        $data  = $this->model->where('image_color_id', $id)->first();
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
     * Date 02/06/2019
     *
     * @param $input
     * @param $image
     * @param $product
     * @return mixed
     */
    public function createKit($input, $image, $product)
    {
        $dataForm['color']          = $image->color;
        $dataForm['kit']            = $product->kit;
        $dataForm['grid']           = $input['grid'];
        $dataForm['product_id']     = $product->id;
        $dataForm['image_color_id'] = $image->id;


        $access = '- '.$product->kit_name;
        $access .= ', '.constLang('grid').':'.$input['grid'];

        if ($product->stock == 1) {

            $dataForm['input'] = $input['input'];
            $access .= ', '.constLang('entry').' '.$input['input'];
            $access .= ', '.constLang('stock').' '.$input['input'];

            if ($product->qty_min == 1) {
                $dataForm['qty_min'] = $input['qty_min'];
                $access .= ', qtd-min:'.$input['qty_min'];
            }

            if ($product->qty_max == 1) {
                $dataForm['qty_max'] = $input['qty_max'];
                $access .= ', qtd-max:'.$input['qty_max'];
            }
        }

        $data = $this->model->create($dataForm);
        if ($data) {
            generateAccessesTxt($access);
        }
        return $data;
    }


    public function createUnit($input, $image, $product)
    {

        dd('Em contrução o invetário');

        foreach ($input as $key => $value) {
            if ($product->stock == 1) {
                $grid = [
                    'product_id' => $product->id,
                    'image_color_id' => $image->id,
                    'kit' => $product->kit,
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

    /**
     * Date: 06/02/2019
     * Note: return empty -> invetary(empty)
     *
     * @param $input
     * @param $image
     * @param $product
     * @param $qty
     * @param $des
     */
    public function updateKit($input, $image, $product, $qty, $des)
    {
        $data = $this->setId($input['id']);

        if ($data->color != $image->color) {
            $dataForm['color'] = $image->color;
        }

        $change = '';
        if ($product->stock == 1) {
            $entry = $input['input'];
            if (!empty($entry)) {

                if ($data->input != $entry) {
                    $dataForm['entry'] = $entry; // inventary -> ammount
                    $dataForm['grid'] = $data->grid; // inventary -> grid
                    $dataForm['grid_id'] = $data->id; // inventary -> grid_id
                    $dataForm['previous_stock'] = $data->stock; // inventary -> grid
                    $previousInput = $data->input;
                    $currentInput = $previousInput + $entry;
                    $previousStock = $data->stock;
                    $currentStock = ($previousStock + $entry) - $data->output;
                    $dataForm['input'] = $currentInput;
                    $dataForm['stock'] = $currentStock;
                    $change .= ' '.constLang('entry').':'.$entry.' '.constLang('stock').':'.$currentStock;
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


        if ($change){
            $update = $data->update($dataForm);
            if ($update) {
                generateAccessesTxt(constLang('updated').''.constLang('grid').$change);
                if ($product->stock == 1) {
                    $data['entry'] = $input['input'];
                    $data['previous_stock'] = $data->id;
                }
                return $data;
            }
        }
        // Note: return empty -> invetary(empty)
    }


    /**
     * @param $input
     * @param $image
     * @param $product
     * @param $qty
     * @param $des
     */
    public function updateUnit($input, $image, $product, $qty, $des)
    {

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