<?php

namespace AVDPainel\Interfaces\Admin;

interface ProductInterface
{
    /**
     * Interface model Product
     *
     * @return \AVDPainel\Repositories\Admin\ProductRepository
     */
    public function getAll($input, $id);
    public function setId($id);
    public function create($input);
    public function update($input, $data, $id);
    public function delete($id, $config);
    public function status($input, $id);

}