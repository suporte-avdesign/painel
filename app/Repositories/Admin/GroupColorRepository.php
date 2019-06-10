<?php

namespace AVDPainel\Repositories\Admin;

use AVDPainel\Models\Admin\GroupColor as Model;
use AVDPainel\Interfaces\Admin\GroupColorInterface;
use Illuminate\Support\Arr;

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
     * Date: 06/07/2019
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
                return $data;
            }
        }
    }


    /**
     * Update
     *
     * @param  array $input
     * @param  int $idpro
     * @param  int $id
     * @return boolean true or false
     */
    public function update($input, $idpro, $image)
    {
        $colors = $image->groups;
        $groups = collect($colors)->where('image_color_id', $image->id)->toArray();
        $count_groups = collect($groups)->where('image_color_id', $image->id)->count();
        $count_inputs = collect($input)->count();
        $i=0;
        foreach ($input as $key => $value) {
            $exePinker = explode("#", $key);
            $exeLabel = explode(":", $value);
            $inputs[$i]['config_color_group_id'] = (int) $exeLabel[0];
            $inputs[$i]['product_id'] =  $idpro;
            $inputs[$i]['image_color_id'] = $image->id;
            $inputs[$i]['pinker'] = $exePinker[1];
            $inputs[$i]['label'] = $exeLabel[1];
            $i++;
        }

        if ($count_groups != $count_inputs) {

            $delete = $this->model->where('image_color_id', $image->id)->delete();
            if ($delete) {

                $title_change = constLang('updated').
                    ' '.constLang('group').
                    ' '.constLang('colors');
                generateAccessesTxt(utf8_decode($title_change));

                foreach ($inputs as $value) {
                    $dataForm = [
                        "config_color_group_id" => $value['config_color_group_id'],
                        "product_id" => $idpro,
                        "image_color_id" => $image->id,
                        "pinker" => $value['pinker'],
                        "label" => $value['label']
                    ];

                    $change = '- '.constLang('color').':'.$value['label'];

                    $upd = $this->model->create($dataForm);
                    if($upd) {
                        generateAccessesTxt(utf8_decode($change));
                    }
                }
            }

        } else {
            if ($count_inputs == 1) {
                $id = $colors[0]->id;
                unset($groups[0]['id']);
                $result = ary_diff($inputs, $groups);
                if (!empty($result)) {
                    $dataForm = $result[0];
                    $previous = $result[1]['label'];
                    $group = $this->model->find($id);
                    $upd = $group->update($dataForm);
                    if ($upd) {
                        $change = constLang('updated').' '.
                            constLang('group').' '.
                            constLang('colors').
                            ':'.$previous.'/'.$dataForm['label'];
                        generateAccessesTxt(utf8_decode($change));
                    } else {
                        return false;
                    }
                }
            } else {

                $title_change = constLang('updated').
                    ' '.constLang('group').
                    ' '.constLang('colors');
                generateAccessesTxt(utf8_decode($title_change));

                foreach ($colors as $key => $color) {
                    if ($inputs[$key]['pinker'] != $color->pinker) {
                        $group = $this->model->find($color->id);
                        $dataForm = [
                            'config_color_group_id' => $inputs[$key]['config_color_group_id'],
                            'pinker' => $inputs[$key]['pinker'],
                            'label' => $inputs[$key]['label']
                        ];
                        $upd = $group->update($dataForm);
                        if ($upd) {
                            $change = constLang('color').':'.$dataForm['label'];
                            generateAccessesTxt(utf8_decode($change));
                        }
                    }
                }

            }

        }

    }


    protected function get_duplicates( $array ) {
        return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
    }





    protected function addInput($inputs, $idpro, $image, $colors)
    {
        foreach ($inputs as $value) {
            $dataForm = [
                'config_color_group_id' => $value['config_color_group_id'],
                'product_id' => $idpro,
                'image_color_id' => $image->id,
                'pinker' => $value['pinker'],
                'label' => $value['label']
            ];



            $group = $this->model->create($dataForm);
            if ($group) {
                $change = constLang('updated') . ' ' .
                    constLang('group') . ' ' .
                    constLang('colors') .
                    ':' . $dataForm['label'];
                generateAccessesTxt(utf8_decode($change));
            } else {
                return false;
            }
        }

    }

}