<?php

namespace AVDPainel\Interfaces\Admin;

interface ConfigTemplateInterface
{
    /**
     * Interface model ConfigTemplate
     *
     * @return \AVDPainel\Repositories\Admin\ConfigTemplateRepository
     */
    public function getAll();
    public function create($input, $message);
    public function update($input, $message);
}