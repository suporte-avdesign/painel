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
                    }
                }

            }

        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  array $input
     * @param  int $id
     * @param  int $idpro
     * @param  int $stock
     * @param  int $kit
     * @return array
     */
    public function update($input, $image, $product, $stock, $kit)
    {
        

        ($kit == 1 ? $kname = 'kit' : $kname = 'Und');
        if ($kit == 1) {
            if ($stock == 1) {
                $output   = $input['output'];
                $input = $input['input'];
                unset($input['output']);
                unset($input['input']);
            }

            foreach ($input as $value) {
                foreach ($value as $val) {
                    $grids[] = $val;
                }
            }

            $grid = implode(",", $grids);


            if ($stock == 1) {

                ($input == '' ? $input = 0 : $input = $input);
                ($output   == '' ? $output   = 0 : $output   = $output);
                $total = $input - $output;
                $update = [
                    'product_id' => $product->id,
                    'image_color_id' => $image->id,
                    'kit' => $kit,
                    'grid' => $grid,
                    'input' =>  $input,
                    'output' => $output,
                    'stock' => $total
                ];

            } else {
                $update = [
                    'product_id' => $product->id,
                    'image_color_id' => $image->id,
                    'kit' => $kit,
                    'grid' => $grid
                ];
            }

            $delete = $this->model->where('image_color_id', $image->id)->delete();
            $data   = $this->model->create($update);

            if ($data) {
                if ($stock == 1) {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.$data->grid.
                        ' - Entrada:'.$data->input.
                        ' - Saida:'.$data->output.
                        ' - Estoque:'.$data->stock.
                        ' - Kit:'.$kname)
                    );
                } else {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.$data->grid.
                        ' - Kit:'.$kname)
                    );
                }

                return true;                         
            }

        } else {
            $delete = $this->model->where('image_color_id', $image->id)->delete();
            if ($delete) {
                foreach ($input as $value) {
                    if ($value['grid'] != '') {
                        if ($stock == 1) {
                            ($value['input'] == '' ? $input = 0 : $input = $value['input']);
                            ($value['output']   == '' ? $output   = 0 : $output   = $value['output']);

                            $total = $input - $output;

                            $update = [
                                'product_id' => $product->id,
                                'image_color_id' => $image->id,
                                'kit' => $kit,
                                'grid' => str_replace('_', '/', $value['grid']),
                                'input' =>  $input,
                                'output' => $output,
                                'stock' => $total
                            ];

                        } else {

                            $update = [
                                'product_id' => $product->id,
                                'image_color_id' => $image->id,
                                'kit' => $kit,
                                'grid' => str_replace('_', '/', $value['grid'])
                            ];
                        }

                        $data   = $this->model->create($update);

                        if ($data) {
                            if ($stock == 1) {
                                generateAccessesTxt(utf8_decode(
                                    '- Grade:'.$data->grid.
                                    ' - Entrada:'.$data->input.
                                    ' - Saida:'.$data->output.
                                    ' - Estoque:'.$data->stock.
                                    ' - Kit:'.$kname)
                                );
                            } else {
                                generateAccessesTxt(utf8_decode(
                                    '- Grade:'.$data->grid.
                                    ' - Kit:'.$kname)
                                );
                            }

                        }
                        
                    }
                }
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