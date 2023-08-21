<?php

namespace App\Http\Controllers;

use App\Http\Traits\FunctionsTraits;

class AssignController extends Controller
{
    use FunctionsTraits;

    public function assignDrivers()
    {

        //Get all Addressess
        $addresses = $this->getDataFile('addresses');
        //Get all Drivers Name
        $drivers = $this->getDataFile('drivers');
        //Send addresses and drivers to a function on our Traits to assign drivers to routes
        $assigned = $this->assignRoutes($addresses, $drivers);
        //Print the collection
        dd($assigned);
    }
}
