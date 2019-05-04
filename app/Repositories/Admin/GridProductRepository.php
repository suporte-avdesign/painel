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
    public function create($input, $id, $idpro, $stock, $kit)
    {
        if ($kit == 1) {

            if ($stock == 1) {
                $grid = [
                    'product_id' => $idpro,
                    'image_color_id' => $id,
                    'kit' => $kit,
                    'grid' => str_replace('_', '/', $input['grid']),
                    'entry' => $input['entry'],
                    'low' => 0,
                    'stock' => $input['entry']
                ];
                $data = $this->model->create($grid);
                if ($data) {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.str_replace('_', '/', $input['grid']).
                        '- Entrada:'.$input['entry'])
                    );
                }

            } else {
                $grid = [
                    'product_id' => $idpro,
                    'image_color_id' => $id,
                    'kit' => $kit,
                    'grid' => str_replace('_', '/', $input['grid']),
                    'entry' => 0,
                    'low' => 0,
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
                        'product_id' => $idpro,
                        'image_color_id' => $id,
                        'kit' => $kit,
                        'grid' => str_replace('_', '/', $key),
                        'entry' => $value,
                        'low' => 0,
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
                        'product_id' => $idpro,
                        'image_color_id' => $id,
                        'kit' => $kit,
                        'grid' => str_replace('_', '/', $key),
                        'entry' => 0,
                        'low' => 0,
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

        /*
        if ($kit == 1) {

            foreach ($input as $key => $value) { 
                if ($stock == 1) {
                    $grid = [
                        'product_id' => $idpro,
                        'image_color_id' => $id,
                        'kit' => $kit,
                        'grid' => str_replace('_', '/', $key),
                        'entry' => $value,
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
                        'product_id' => $idpro,
                        'image_color_id' => $id,
                        'kit' => $kit,
                        'grid' => str_replace('_', '/', $key)
                    ];
                    $data = $this->model->create($grid);
                    if ($data) {
                        generateAccessesTxt(utf8_decode(
                            '- Grade:'.str_replace('_', '/', $key))
                        );
                    }
                }

            }

        } else {
            foreach ($input as $key => $value) {
                if ($value >= 1) {
                    if ($stock == 1) {
                        ($value == '' ? $entry = 0 : $entry = $value);
                        $grid = [
                            'product_id' => $idpro,
                            'image_color_id' => $id,
                            'grid' => str_replace('_', '/', $key),
                            'kit' => $kit,
                            'entry' => $entry,
                            'stock' => $entry
                        ];
                    } else {
                        $grid = [
                            'product_id' => $idpro,
                            'image_color_id' => $id,
                            'kit' => $kit,
                            'grid' => str_replace('_', '/', $key)
                        ];
                    }

                    $data = $this->model->create($grid);
                    if ($data) {
                        if ($stock == 1) {
                            generateAccessesTxt(utf8_decode(
                                '- Grade:'.$key.
                                '- Entrada:'.$entry)
                            );
                        } else {
                            generateAccessesTxt(utf8_decode(
                                '- Grade:'.$key)
                            );
                        }
                    }
                }
            }
        }
        */

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
    public function update($input, $id, $idpro, $stock, $kit)
    {
        

        ($kit == 1 ? $kname = 'kit' : $kname = 'Und');
        if ($kit == 1) {
            if ($stock == 1) {
                $low   = $input['low'];
                $entry = $input['entry'];
                unset($input['low']);
                unset($input['entry']);
            }

            foreach ($input as $value) {
                foreach ($value as $val) {
                    $grids[] = $val;
                }
            }

            $grid = implode(",", $grids);


            if ($stock == 1) {

                ($entry == '' ? $entry = 0 : $entry = $entry);
                ($low   == '' ? $low   = 0 : $low   = $low);
                $total = $entry - $low;
                $update = [
                    'product_id' => $idpro,
                    'image_color_id' => $id,
                    'kit' => $kit,
                    'grid' => $grid,
                    'entry' =>  $entry,
                    'low' => $low,
                    'stock' => $total
                ];

            } else {
                $update = [
                    'product_id' => $idpro,
                    'image_color_id' => $id,
                    'kit' => $kit,
                    'grid' => $grid
                ];
            }

            $delete = $this->model->where('image_color_id', $id)->delete();
            $data   = $this->model->create($update);

            if ($data) {
                if ($stock == 1) {
                    generateAccessesTxt(utf8_decode(
                        '- Grade:'.$data->grid.
                        ' - Entrada:'.$data->entry.
                        ' - Saida:'.$data->low.
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
            $delete = $this->model->where('image_color_id', $id)->delete();
            if ($delete) {
                foreach ($input as $value) {
                    if ($value['grid'] != '') {
                        if ($stock == 1) {
                            ($value['entry'] == '' ? $entry = 0 : $entry = $value['entry']);
                            ($value['low']   == '' ? $low   = 0 : $low   = $value['low']);

                            $total = $entry - $low;

                            $update = [
                                'product_id' => $idpro,
                                'image_color_id' => $id,
                                'kit' => $kit,
                                'grid' => str_replace('_', '/', $value['grid']),
                                'entry' =>  $entry,
                                'low' => $low,
                                'stock' => $total
                            ];

                        } else {

                            $update = [
                                'product_id' => $idpro,
                                'image_color_id' => $id,
                                'kit' => $kit,
                                'grid' => str_replace('_', '/', $value['grid'])
                            ];
                        }

                        $data   = $this->model->create($update);

                        if ($data) {
                            if ($stock == 1) {
                                generateAccessesTxt(utf8_decode(
                                    '- Grade:'.$data->grid.
                                    ' - Entrada:'.$data->entry.
                                    ' - Saida:'.$data->low.
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
            $entry=0;
            $low=0;
            foreach ($current as $value) {
                $product_id = $value->product_id;
                $entry += $value->entry;
                $low += $value->low;
                if ($value->kit == 0) {
                    $grids[] = $value->grid;
                }
            }
            if (isset($grids)) {

                $grid   = implode(",", $grids);
                $total  = $entry - $low;
                $delete = $this->model->where('image_color_id', $id)->delete();

                if ($stock == 1) {
                    $update = [
                        'product_id' => $product_id,
                        'image_color_id' => $id,
                        'grid' => $grid,
                        'kit' => $kit,
                        'entry' => $entry,
                        'low' => $low,
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
                            'entry' => 0,
                            'low' => 0,
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