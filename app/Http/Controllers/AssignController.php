<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Traits\FunctionsTraits;

class AssignController extends Controller
{
    use FunctionsTraits;

    public function getDrivers()
    {

        //Get data from txt file
        $data = Storage::get('public/10-list-drivers.txt');
        //Every End Of Line put ","
        $array = str_replace(PHP_EOL, ",", $data);
        //Create an array exploding data with ","
        $drivers = explode(',', $array);
        //Clean array from empty data
        $drivers = array_filter($drivers);

        return $drivers;
    }

    public function getAddresses()
    {

        //Get data from txt file
        $data = Storage::get('public/10-list-addresses.txt');
        //Create an array exploding data with End of Line
        $addresses = explode(PHP_EOL, $data);
        //Clean array from empty data
        $addresses = array_filter($addresses);

        return $addresses;
    }

    public function assignDrivers()
    {

        //Get all Addressess
        $addresses = $this->getAddresses();
        //Get all Drivers Name
        $drivers = $this->getDrivers();

        //Send addresses and drivers to a function on our Traits to assign drivers to routes
        $assigned = $this->assignRoutes($addresses, $drivers);

        //Print the collection
        dd($assigned);
    }
}
