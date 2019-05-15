<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\ConfigTemplate as Model;
use AVDPainel\Interfaces\Admin\ConfigTemplateInterface;



class ConfigTemplateRepository implements ConfigTemplateInterface
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


    public function getAll()
    {
        $data = $this->model->getAll();
        return $data;
    }


    public function create($input, $message)
    {
        $data = $this->model->create($input);
        if ($data) {
            return true;
        } 

        return false;
    }


    public function update($input, $message)
    {
        $data  = $this->get();
        $update = $data->update($input);
        if ($update) {

            $config = array(
                'table_color' => $data->table_color,
                'table_color_sel' => $data->table_color_sel, 
                'table_limit' => $data->table_limit, 
                'table_open_details' => $data->table_open_details 
            );
            $out = array(
                "configUser" => $config
            );

            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Alterou sua configuração do sistema por uma de sua preferência.')
            );
            
            return true;
        }
        return false;
    }


}