<?php

namespace AVDPainel\Interfaces\Admin;

interface InventaryInterface
{
    /**
     * Interface model Inventary
     *
     * @return \AVDPainel\Repositories\Admin\InventaryRepository
     */
    public function getAll();
    public function setId($id);
    public function create($input);
    public function update($input, $id);
    public function delete($id);
    public function rules($input, $messages, $id);

}