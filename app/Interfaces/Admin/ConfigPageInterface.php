<?php

namespace AVDPainel\Interfaces\Admin;

interface ConfigPageInterface
{
    /**
     * Interface model ConfigPage
     *
     * @return \AVDPainel\Repositories\Admin\ConfigPageRepository
     */
    public function getAll();
    public function create($input, $message);
    public function update($input, $message);
}