<?php
namespace Controller;

use Model\Companion;

class Companion
{
    public function save()
    {
        $something = new Companion();
        $something->something = "Scooby Doo";
        $something->save();
    }
}
