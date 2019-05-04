<?php

namespace AVDPainel\Events;


class UserAddressCreatedEvent
{
    /**
     * @var UserAddressInterface
     */
    private $address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        //
        $this->address = $address;
    }

    /**
     * @return UserAddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }


}
