<?php

namespace AVDPainel\Interfaces\Admin;

interface GridProductInterface
{
    /**
     * Interface model GridProduct
     *
     * @return \AVDPainel\Repositories\Admin\GridProductRepository
     */
    public function get($id);
    public function setId($id);
    public function create($input, $id, $idpro, $stock, $kit);
    public function update($input, $id, $idpro, $stock, $kit);
    public function delete($id);
    public function change($id, $stock, $kit);
}