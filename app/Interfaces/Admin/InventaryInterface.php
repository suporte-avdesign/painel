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

    public function createKit($grids, $image, $product);
    public function createUnit($grids, $image, $product);

    public function rules($input, $messages, $id);

}