<?php

namespace AVDPainel\Interfaces\Admin;

interface ConfigImageProductInterface
{
    /**
     * Interface model ConfigImageProduct 
     *
     * @return \AVDPainel\Repositories\Admin\ConfigImageProductRepository
     */
    public function get();
    public function getAll($input);
    public function setId($id);
    public function setName($field, $name);
    public function create($input);
    public function update($input, $id);
    public function delete($id);
    public function rules($input, $messages, $id);
}