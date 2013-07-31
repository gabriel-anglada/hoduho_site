<?php

namespace Entity;

/**
 * Created by JetBrains PhpStorm.
 * User: Gabri
 * Date: 31/07/13
 * Time: 9:10
 * To change this template use File | Settings | File Templates.
 */
class BaseService
{
    protected $duration;

    protected $email;

    protected $phone;

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}
