<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Models\Admin\GroupColor as Model;
use AVDPainel\Interfaces\Admin\GroupColorInterface;

class GroupColorRepository implements GroupColorInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model    = $model;
    }

    /**
     * Init Model
     *
     * @param  string  $field
     * @param  int  $id
     * @return array
     */
    public function get($field, $id)
    {
        $data  = $this->model->where($field, $id)->get();
        return $data;    
    }



    /**
     * Create
     *
     * @param  array $input
     * @param  int $idpro
     * @param  int $id
     * @return boolean true or false
     */
    public function create($input, $idpro, $id)
    {
        foreach ($input as $key => $value) {
            
            $exePinker = explode("#", $key);
            $pinker    = $exePinker[1];
            $exeLabel  = explode(":", $value);
            $idgro     = $exeLabel[0];
            $label     = $exeLabel[1];

            $group = [
                "config_color_group_id" => $idgro,
                "product_id" => $idpro,
                "image_color_id" => $id,
                "pinker" => $pinker,
                "label" => $label
            ];
            
            $data = $this->model->create($group);

            if($data) {
                generateAccessesTxt(utf8_decode('- Grupo:'.$label));
            }
        }

        return false;
    }


    /**
     * Update
     *
     * @param  array $input
     * @param  int $idpro
     * @param  int $id
     * @return boolean true or false
     */
    public function update($input, $idpro, $id)
    {
        
        $delete = $this->model->where('image_color_id', $id)->delete();
        if ($delete) {

            foreach ($input as $key => $value) {
                
                $exePinker = explode("#", $key);
                $pinker    = $exePinker[1];
                $exeLabel  = explode(":", $value);
                $idgro     = $exeLabel[0];
                $label     = $exeLabel[1];

                $group = [
                    "config_color_group_id" => $idgro,
                    "product_id" => $idpro,
                    "image_color_id" => $id,
                    "pinker" => $pinker,
                    "label" => $label
                ];
                
                $data = $this->model->create($group);

                if($data) {
                    generateAccessesTxt(utf8_decode('- Grupo:'.$label));
                }
            }
        }

        return false;   

    }


}