<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\ImageAdmin as Model;
use AVDPainel\Interfaces\Admin\AdminInterface as InterAdmin;
use AVDPainel\Interfaces\Admin\ImageAdminInterface;
use Intervention\Image\Facades\Image;

use Illuminate\Foundation\Validation\ValidatesRequests;

class ImageAdminRepository implements ImageAdminInterface
{
    use ValidatesRequests;

    public $model;
    public $interAdmin;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model, InterAdmin $interAdmin)
    {
        $this->model      = $model;
        $this->interAdmin = $interAdmin;
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
        $data  = $this->model->where('admin_id', $id)->get();
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
     * @param  int $id module
     * @param  array $input
     * @return boolean true or false
     */
    public function create($input, $id)
    {
        $mode = $this->interAdmin->setId(numLetter($id));
        $conf = $input['config'];
        $file = $input['image'];
        $ext  = $file->getClientOriginalExtension();
        $name = str_slug($mode->name).'-'.time().'.'.$ext;
        $path = $conf['path'].$name;
        $file->move($conf['path'], $name);
        $upload = Image::make($path)->resize($conf['width'], $conf['height'])->save();
        if ($upload) {

            $input['image'] = $name;
            $data = $this->model->create($input);
            if ($data) { 
         
                generateAccessesTxt(date('H:i:s').utf8_decode(
                    ' Adicionou a foto do usuário:'. $mode->name)
                );

                ($data->status == 'Ativo' ? $class = 'button icon-tick green-gradient' : $class = 'button icon-tick red-gradient');

                $route_status = route('photo.admin.status', $data->id);
                $route_delete = route('foto-admin.destroy', ['id' => $id, 'file' => $data->id]);
                $route_edit   = route('foto-admin.edit', ['id' => $id, 'file' => $data->id]);

                $out = array(
                    "success"    => true,
                    "message"    => "A foto foi salva.",
                    'ac'         => 'create',
                    "id"         => $data->id,
                    'idm'        => $id,
                    "path"       => url($path),
                    "status"     => $data->status,
                    "btn"        => $conf['btn'],
                    "class"      => $class,
                    'token'      => csrf_token(),
                    "url_status" => "statusImage('{$data->id}', '".$route_status."', '".csrf_token()."')",
                    "url_delete" => "deleteImage('{$data->id}', '".$route_delete."', '".csrf_token()."')",
                    "url_edit"   => "abreModal('Editar: {$data->type}', '".$route_edit."', 'form-image', 2, 'true', 500, 400)"
                );

                return $out;
            }
        }

        return array(
            'success' => false,
            'message' => "Não foi possível altera a foto.");

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id brand
     * @param  int $idfile 
     * @param  array $input
     * @return boolean true or false
     */
    public function update($input, $id, $idfile)
    {
        $data = $this->model->find($idfile);
        $mode = $this->interAdmin->setId(numLetter($id));
        $conf = $input['config'];
        // Remove image current
        $current = $conf['path'].$data->image;
        if (file_exists($current)) {
            unlink($current);
        }

        $file = $input['image'];
        $ext  = $file->getClientOriginalExtension();
        $name = str_slug($mode->name).'-'.time().'.'.$ext;
        $path = $conf['path'].$name;
        $file->move($conf['path'], $name);
        $status = $data->status;
        $upload = Image::make($path)->resize($conf['width'], $conf['height'])->save();

        if ($upload) {

            $input['image'] = $name;

            $update = $data->update($input);
            if ($update) {
                generateAccessesTxt(
                    date('H:i:s').utf8_decode(
                    " Alterou a foto do usuário ". $mode->name.
                    ', Status:'.$status)
                );

                ($data->status == 'Ativo' ? $class = 'button icon-tick green-gradient' : $class = 'button icon-tick red-gradient');
                $route_status = route('photo.admin.status', $data->id);
                $route_delete = route('foto-admin.destroy', ['id' => $id, 'file' => $data->id]);
                $route_edit = route('foto-admin.edit', ['id' => $id, 'file' => $data->id]);

                $out = array(
                    "success"    => true,
                    "message"    => "A foto foi alterada.",
                    'ac'         => 'update',
                    "id"         => $data->id,
                    'idm'        => $id,
                    "path"       => url($path),
                    "status"     => $data->status,
                    "btn"        => $conf['btn'],
                    "class"      => $class,
                    'token'      => csrf_token(),
                    "url_status" => "statusImage('{$data->id}', '" . $route_status . "', '" . csrf_token() . "')",
                    "url_delete" => "deleteImage('{$data->id}', '" . $route_delete . "', '" . csrf_token() . "')",
                    "url_edit" => "abreModal('Editar: {$data->type}', '" . $route_edit . "', 'form-image', 2, 'true', 500, 400)"
                );

                return $out;
            }
        }

        return array(
            'success' => false,
            'message' => "Não foi possível alterar a foto");
    }

    /**
     * Remove
     *
     * @param  int $id
     * @return boolean true or false
     */
    public function delete($id, $config='')
    {

        $data   = $this->model->find($id);
        $admin  = $data->admin;

        $image = $config['path'].$data->image;
        if (file_exists($image)) {
            unlink($image);
        }

        $delete = $data->delete();
        if ($delete) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                ' Excluiu a foto do usuário: '.$admin->name)
            );
            return true;
        }
        return false;
    }


    /**
     * Status
     *
     * @param  int $id 
     * @return json
     */
    public function status($id)
    {
        $data = $this->model->find($id);
        $mode = $this->interAdmin->setId($data->admin_id);

        ($data->status == 'Ativo' ? $change = ['status' => 'Inativo'] : $change = ['status' => 'Ativo']);

        $update = $data->update($change);
        if ($update) {
            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                " Alterou o status da foto do usuário ". $mode->name.
                ', para '.$data->status)
            );

            ($data->status == 'Ativo' ? $class = 'button icon-tick green-gradient' : $class = 'button icon-tick red-gradient');

            $out = array(
                "success"    => true,
                "message"    => "A status da foto foi alterado.",
                "class"      => $class
            );               

            return $out;
        }

        return array(
            'success' => false,
            'message' => "Não foi possível alterar o status.");

    }

}