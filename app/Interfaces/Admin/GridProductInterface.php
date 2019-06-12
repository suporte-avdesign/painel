<?php

namespace AVDPainel\Interfaces\Admin;

interface GridProductInterface
{
    /**
     * Interface model GridProduct
     *
     * @return \AVDPainel\Repositories\Admin\GridProductRepository
     */
    public function setId($id);
    public function createKit($configProduct, $input, $image, $product);
    public function createUnit($configProduct,$input, $image, $product);
    public function updateKit($configProduct, $input, $image, $product, $qty, $des);
    public function updateUnit($configProduct,$input, $image, $product, $qty, $des);
    public function delete($configProduct, $image, $product);
    public function change($id, $stock, $kit);
}