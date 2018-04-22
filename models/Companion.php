<?php
namespace Models;

use Phalcon\Mvc\Model;

class Companion extends Model
{
    protected $id_route;
    protected $id_profile;

    public function getIdRoute()
    {
        return $this->id_route;
    }

    public function setIdRoute($id_route)
    {
        $this->id_route = $id_route;
    }

    public function setIdProfile()
    {
        return $this->id_profile;
    }

    public function setIdProfile($id_profile)
    {
        $this->id_profile = $id_profile;
    }
}
