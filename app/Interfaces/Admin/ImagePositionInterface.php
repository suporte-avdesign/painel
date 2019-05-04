<?php

namespace AVDPainel\Interfaces\Admin;

interface ImagePositionInterface
{
    /**
     * Interface model ImagePosition
     *
     * @return \AVDPainel\Repositories\Admin\ImagePositionRepository
     */
    public function get($id);
    public function setId($id);
    public function create($input, $config, $file);
    public function update($input, $id, $config, $file);
    public function delete($id, $config);
    public function status($input, $id);
    
}