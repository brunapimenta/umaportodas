<?php
namespace Controller;

use Model\Profile;

class Profile
{
    public function save()
    {
        $something = new Profile();
        $something->something = "Scooby Doo";
        $something->save();
    }
}
