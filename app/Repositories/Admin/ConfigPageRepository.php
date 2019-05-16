<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\ConfigPage as Model;
use AVDPainel\Interfaces\Admin\ConfigPageInterface;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;

class ConfigPageRepository implements ConfigPageInterface
{
    use ValidatesRequests;

    public $model;

    /**
     * ValidatesRequests
     *
     * @param  array $input
     * @param  array $messages
     * @return array
     */
    public function rules($input, $messages, $id='')
    {
        $this->validate($input, $this->model->rules($id), $messages);
    }

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
        return $this->model->orderBy('name')->get();
        return $data;
    }


    public function create($input, $message)
    {
        $input['module'] = Str::slug($input['module'], "-");

        $data = $this->model->create($input);
        if ($data) {
            $success = true;
            $message = $message['create_true'];
        } else {
            $success = false;
            $message = $message['create_false'];
        }

        $out = array(
            "success" => $success,
            "message" => $message
        );

        return $out;
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