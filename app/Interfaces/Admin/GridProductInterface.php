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
    public function getKit($id);
    public function getUnit($id);
    public function createKit($input, $image, $product);
    public function createUnit($input, $image, $product);
    public function updateKit($input, $image, $product, $qty, $des);
    public function updateUnit($input, $image, $product, $qty, $des);
    public function delete($id);
    public function change($id, $stock, $kit);
}