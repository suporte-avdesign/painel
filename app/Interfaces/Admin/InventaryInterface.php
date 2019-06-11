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

    public function createKit($configProduct, $grids, $image, $product, $photo);
    public function createUnit($configProduct,$grids, $image, $product, $photo);
    public function updateKit($configProduct, $grids, $image, $product, $photo);
    public function updateUnit($configProduct,$grids, $image, $product, $photo);
    public function deleteKit($product, $image, $grids);
    public function deleteUnit($product, $image, $grids);

    public function rules($input, $messages, $id);

}