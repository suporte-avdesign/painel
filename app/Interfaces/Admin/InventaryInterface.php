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
    public function create($grids, $image, $product, $kit);
    public function rules($input, $messages, $id);

}