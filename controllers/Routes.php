<?php
namespace Controllers;

use Model\Routes;

class Routes
{
    public function save()
    {
        $something = new Routes();
        $something->something = "Scooby Doo";
        $something->save();
    }
}
