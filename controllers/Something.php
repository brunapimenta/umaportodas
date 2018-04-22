<?php
namespace Controllers;

use Model\Something;

class Something
{
    public function save()
    {
        $something = new Something();
        $something->something = "Scooby Doo";
        $something->save();
    }
}
