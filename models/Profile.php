<?php
namespace Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use InvalidArgumentException;

class Profile extends Model
{
    public $id_profile;
    public $name;
    public $phone;
    public $email;
    public $age;
    public $photo_url;
    public $profile_url;
    public $created_at;

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

    public function getIdProfile()
    {
        return $this->id_profile;
    }

    public function setName($name)
    {
        if (strlen(trim($name)) === 0) {
            throw new InvalidArgumentException("The name can't be empty");
        }

        $this->name = trim($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = trim($phone);
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        if (strlen(trim($email)) === 0) {
            throw new InvalidArgumentException("The email can't be empty");
        }

        $this->email = trim($email);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setAge($age)
    {
        $this->age = trim($age);
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setPhotoUrl($photo_url)
    {
        $this->photo_url = trim($photo_url);
    }

    public function getPhotoUrl()
    {
        return $this->photo_url;
    }

    public function setProfileUrl($profile_url)
    {
        $this->profile_url = trim($profile_url);
    }

    public function getProfileUrl()
    {
        return $this->profile_url;
    }
}
