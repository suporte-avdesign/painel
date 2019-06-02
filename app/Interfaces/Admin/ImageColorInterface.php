<?php

namespace AVDPainel\Interfaces\Admin;

interface ImageColorInterface
{
    /**
     * Interface model ImageColor
     *
     * @return \AVDPainel\Repositories\Admin\ImageColorRepository
     */
    public function get($id);
    public function setId($id);
    public function getAll($request);
    public function create($input, $config);
    public function update($input, $id, $config, $file);
    public function uploadImages($input, $image, $config, $file);
    public function delete($id, $product, $config);
    public function status($input, $product, $id);
    public function changeGrids($input, $id);
    // All Colors
    public function colorsStatus($input, $product, $id);
    // Search Products Wishlist/Orders
    function search($request, $mod_id, $route);


}