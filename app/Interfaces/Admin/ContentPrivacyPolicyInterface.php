<?php

namespace AVDPainel\Interfaces\Admin;

interface ContentPrivacyPolicyInterface
{
    /**
     * Interface model ContentPrivacyPolice
     *
     * @return \AVDPainel\Repositories\Admin\ContentPrivacyPoliceRepository
     */
    public function getAll();
    public function setId($id);
    public function create($input, $message);
    public function update($input, $id, $message);
    public function delete($id, $message);
    public function status($id, $message);
    public function getOrder($id);
    public function updateOrder($input, $messages);
    public function rules($input, $messages, $id);
   
}