<?php
namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Routes extends Model
{
    protected $id_route;
    protected $lat_from;
    protected $lgt_from;
    protected $lat_to;
    protected $lgt_to;
    protected $vehicle;
    protected $favorite;
    protected $id_profile;
    protected $created_at;

    public function initialize()
    {
        $this->addBehavior(
            new Timestampable(
                [
                    "beforeCreate" => [
                        "field"  => "created_at",
                        "format" => "Y-m-d H:i:s",
                    ]
                ]
            )
        );
    }

    public function getIdRoute()
    {
        return $this->id_route;
    }

    public function setLatFrom($lat_from)
    {
        if (strlen(trim($lat_from)) === 0) {
            throw new InvalidArgumentException("The latitude of origin can't be empty");
        }

        $this->lat_from = trim($lat_from);
    }

    public function getLatFrom()
    {
        return $this->lat_from;
    }

    public function setLgtFrom($lgt_from)
    {
        if (strlen(trim($lgt_from)) === 0) {
            throw new InvalidArgumentException("The longitude of origin can't be empty");
        }

        $this->lgt_from = trim($lgt_from);
    }

    public function getLgtFrom()
    {
        return $this->lgt_from;
    }

    public function setLatTo($lat_to)
    {
        if (strlen(trim($lat_to)) === 0) {
            throw new InvalidArgumentException("The latitude of destiny can't be empty");
        }

        $this->lat_to = trim($lat_to);
    }

    public function getLatTo()
    {
        return $this->lat_to;
    }

    public function setLgtTo($lgt_to)
    {
        if (strlen(trim($lgt_to)) === 0) {
            throw new InvalidArgumentException("The longitude of destiny can't be empty");
        }

        $this->lgt_to = trim($lgt_to);
    }

    public function getLgtTo()
    {
        return $this->lgt_to;
    }

    public function setVehicle($vehicle)
    {
        if (strlen(trim($vehicle)) === 0) {
            throw new InvalidArgumentException("The vehicle can't be empty");
        }

        $this->vehicle = trim($vehicle);
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setFavorite($favorite)
    {
        $this->favorite = (int) $favorite;
    }

    public function getFavorite()
    {
        return (bool) $this->favorite;
    }
}
