<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\GridCategory as Model;
use AVDPainel\Interfaces\Admin\GridCategoryInterface;

use Illuminate\Foundation\Validation\ValidatesRequests;

class GridCategoryRepository implements GridCategoryInterface
{
    use ValidatesRequests;

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
     * Init Model
     *
     * @return array
     */
    public function getAll($id)
    {
        $data  = $this->model->where('category_id', $id)->get();
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
     * @param  int $id category
     * @param  array $input
     * @return boolean true or false
     */
    public function create($input, $id)
    {
        $input['category_id'] = $id;

        $data = $this->model->create($input);
        if ($data) { 

            $ship   = $data->category;
     
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Adicionou a Grade:'.$data->name.
                ', Tam:'.$data->label.
                ', Tipo:'.$data->type.
                ', Categoria:'.$ship->name)
            );

            $out = array(
                "id"         => $data->id,
                'type'       => $data->type,
                "name"       => $data->name,
                "label"      => $data->label,
                "success"    => true,
                'token'      => csrf_token(),
                "url_delete" => route('grids-category.destroy', ['id' => $id, 'grid' => $data->id]),
                "url_edit"   => route('grids-category.edit', ['id' => $id, 'grid' => $data->id]),
                "message"    => 'A grade '.$data->name.' foi criada.',
            );

            return $out;
        }

        return array(
            'success' => false,
            'message' => 'Não foi possível altera a grade.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id category
     * @param  int $idgrid 
     * @param  array $input
     * @return boolean true or false
     */
    public function update($input, $id, $idgrid)
    {
        $data    = $this->model->find($idgrid);
        $ship    = $data->category;
        $type    = $data->type;
        $grid    = $data->name;
        $label   = $data->label;

        $update = $data->update($input);
        if ($update) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Alterou a Grade:'.$grid.
                ', Tam:'.$label.
                ', Tipo:'.$type.
                ', Categoria:'.$ship->name.
                ' para Grade:'.$data->name.
                ', Tam:'.$data->label)
            );

            $out = array(
                "id"         => $data->id,
                'type'       => $data->type,
                "name"       => $data->name,
                "label"      => $data->label,
                "success"    => true,
                'token'      => csrf_token(),
                "url_delete" => route('grids-category.destroy', ['id' => $id, 'grid' => $data->id]),
                "url_edit"   => route('grids-category.edit', ['id' => $id, 'grid' => $data->id]),
                "message"    => 'A grade '.$data->name.' foi alterada.',
            );

            return $out;
        }

        return array(
            'success' => false,
            'message' => 'Não foi possível altera a grade.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id category
     * @return boolean true or false
     */
    public function delete($id)
    {
        $data   = $this->model->find($id);
        $ship   = $data->category;
        $delete = $data->delete();
        if ($delete) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Excluiu a Grade:'.$data->name.
                ', Tam:'.$data->label.
                ', Categoria:'.$ship->name)
            );
            return true;
        }
        return false;
    }
}