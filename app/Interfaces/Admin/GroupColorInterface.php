<?php

namespace AVDPainel\Interfaces\Admin;

interface GroupColorInterface
{
    /**
     * Interface model GroupColor
     *
     * @return \AVDPainel\Repositories\Admin\GroupColorRepository
     */
    public function get($field, $id);
    public function create($input, $idpro, $id);
    public function update($input, $idpro, $id);
}