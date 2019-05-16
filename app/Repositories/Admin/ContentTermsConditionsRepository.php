<?php

namespace AVDPainel\Repositories\Admin;


use AVDPainel\Models\Admin\ContentTermsConditions as Model;
use AVDPainel\Interfaces\Admin\ContentTermsConditionsInterface;

use Illuminate\Foundation\Validation\ValidatesRequests;

class ContentTermsConditionsRepository implements ContentTermsConditionsInterface
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

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('order')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $input
     * @return bool
     */
    public function create($input, $message)
    {
        $input['description'] = trim($input['description']);
        $count = strlen($input['order']);
        if ($count == 1) {
            $input['order'] = '0'.$input['order'];
        }

        $data = $this->model->create($input);

        if ($data) {

            $acc = $message['accesses'];
            $fid = $message['fields'];

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', '.$acc['create'].
                    ', '.$fid['order'].':'.$data->order.
                    ', '.$fid['status'].':'.$data->status.
                    ', '.$fid['title'].':'.$data->title.
                    ', '.$fid['description'].':'.strip_tags($data->description))
            );

            $success = true;
            $message = $message['create_true'];

        } else {
            $success = true;
            $message = $message['create_false'];
        }

        $out = array(
            "success" => $success,
            "message" => $message
        );

        return $out;
    }

    /**
     * @param $input
     * @param $id
     * @return bool
     */
    public function update($input, $id, $message)
    {
        $input['description'] = trim($input['description']);

        $data = $this->setId($id);

        $update = $data->update($input);
        if ($update) {

            $acc = $message['accesses'];
            $fid = $message['fields'];

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', '.$acc['update'].
                    ', '.$fid['order'].':'.$data->order.
                    ', '.$fid['status'].':'.$data->status.
                    ', '.$fid['title'].':'.$data->title.
                    ', '.$fid['description'].':'.strip_tags($data->description))
            );

            $success = true;
            $message = $message['update_true'];
        } else {
            $success = false;
            $message = $message['update_false'];
        }

        $out = array(
            "success" => $success,
            "message" => $message,
            "title" => $input['title'],
            "description" => $input['description']
        );

        return $out;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id, $message)
    {
        $data   = $this->setId($id);
        $delete = $data->delete();
        if ($delete) {

            $acc = $message['accesses'];
            $fid = $message['fields'];

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', '.$acc['delete'].
                    ', '.$fid['order'].':'.$data->order.
                    ', '.$fid['status'].':'.$data->status.
                    ', '.$fid['title'].':'.$data->title.
                    ', '.$fid['description'].':'.strip_tags($data->description))
            );
            $success = true;
            $message = $message['delete_true'];
        } else {
            $success = false;
            $message = $message['delete_false'];

        }

        $out = array(
            "success" => $success,
            "message"=> $message
        );

        return $out;
    }


    /**
     * Alterar Status
     *
     * @param  int $id
     * @return json
     */
    public function status($id, $message)
    {

        $data = $this->model->find($id);
        ($data->status == 'Ativo' ? $change = ['status' => 'Inativo'] : $change = ['status' => 'Ativo']);

        $update = $data->update($change);
        if ($update) {

            $acc = $message['accesses'];
            $fid = $message['fields'];

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', '.$acc['update'].
                    ', '.$fid['order'].':'.$data->order.
                    ', '.$fid['status'].':'.$data->status.
                    ', '.$fid['title'].':'.$data->title.
                    ', '.$fid['description'].':'.strip_tags($data->description))
            );

            ($data->status == 'Ativo' ? $class = 'button icon-tick with-tooltip' : $class = 'button icon-tick with-tooltip red');

            $out = array(
                "success" => true,
                "message" => "{$message['status_true']} para {$data->status}",
                "class"   => $class,
                "text"    => $data->status
            );

        } else {
            $out = array(
                "success"    => false,
                "message"    => "{$message['status_false']} para {$change['status']}"
            );
        }

        return $out;
    }



    /**
     * Retorna o input ordem
     *
     * @param $id
     * @return mixed
     */
    public function getOrder($id)
    {
        $data = $this->setId($id);
        return $data->order;
    }

    /**
     * Alterar ordem
     *
     * @param $input
     * @param $messages
     * @return array
     */
    public function updateOrder($input, $message)
    {
        $change['order'] = $input['order'];

        if (strlen($input['order']) == 1) {
            $change['order'] = '0'.$input['order'];
        }
        $data = $this->setId($input['id']);

        $update = $data->update($change);
        if ($update) {

            $acc = $message['accesses'];
            $fid = $message['fields'];

            generateAccessesTxt(date('H:i:s').utf8_decode(
                    ', '.$acc['update'].
                    ', '.$fid['order'].':'.$data->order.
                    ', '.$fid['status'].':'.$data->status.
                    ', '.$fid['title'].':'.$data->title.
                    ', '.$fid['description'].':'.strip_tags($data->description))
            );

            $success = true;
            $message = "{$message['order_true']} para {$data->order}";

        } else {
            $success = false;
            $message = $message['order_false'];
        }

        $out = array(
            "success" => $success,
            "message" => $message,
        );

        return $out;
    }


}