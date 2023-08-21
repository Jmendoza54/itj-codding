<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait FunctionsTraits {

    private function isEven($streetName)
    {
        //Verify length of streetname is Even
        if (Str::length($streetName) % 2 == 0) {
            return true;
        }

        //Return false if is Odd
        return false;
    }

    private function lengthDriverName($driverName, $kind)
    {
        //WE will compare to match with the option selected
        $vowels = '/[aeiou]/i';
        $consonants = '/[bcdfghjklmnpqrstvwxyz]/i';

        //Set match with the option received
        $match = ($kind == 'vowels') ? $vowels : $consonants;

        $count = 0;

        foreach (count_chars($driverName, 1) as $i => $val) {
            //Compare all the string, if match with the compare selected, plus one to count
            if (preg_match($match, chr($i))) {
                $count = $count + $val;
            }
        }

        //Return the total of vowels or consonants contain the string
        return $count;
    }

    public function assignRoutes($addresses, $drivers){

        //Create collection to return routes assigned to drivers
        $assigned = new Collection();

        //Clean address by addres to get street name
        foreach ($addresses as $key => $address) {
            //Explode address to an array to get street name
            $streetName = $addresses = explode(",", $address);
            //remove number, apartment or suite word to get clean street name
            $streetName = Str::remove([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, "Apt.", "Suite"], $streetName[0]);
            //Delete all extraneous white space
            $streetName = Str::squish($streetName);
            //Get if is Even or Odd => Street Name
            $isEven = $this->isEven($streetName);

            //Define the base to multiply and if take vowels or consonants depending is Even Or Odd
            if ($isEven) {
                $kindLength = 'vowels';
                $multiplyBy = 1.5;
            } else {
                $kindLength = 'consonants';
                $multiplyBy = 1;
            }
            //Declarate a SS value to set the SS bigger
            $ssSelected = 0;
            //Use index to remove the driver selected from the array
            $index = 0;

            foreach ($drivers as $id => $driver) {
                //Return count from vowels or consonants from driver's name
                $counthDriverName = $this->lengthDriverName($driver, $kindLength);
                //Get the base SS for the driver
                $ss = $counthDriverName * $multiplyBy;


                //Compare the length for street name and driver name
                if (Str::length($streetName) == Str::length($driver)) {
                    //if is equal explode both names to compare length
                    $arrayStreet = explode(' ', $streetName);
                    $arrayDriver = explode(' ', $driver);

                    //Compare length to check if the street name and driver name share any common factor  Example => Noemie Murphy & Dessie Lights has same length if we explode the names in 2 elements
                    if(Str::length($arrayStreet[0]) == Str::length($arrayDriver[0]) || Str::length($arrayStreet[0]) == Str::length($arrayDriver[1])){
                        $ss = $ss + ($ss * .5);
                    }
                }
                //We compare the last ss saved, if the current ss is bigger than last saved, we replace the value and set the index to remove the elemnt from the array
                if ($ss > $ssSelected) {
                    $ssSelected = $ss;
                    $index = $key;
                }
            }
            //We set address with driver selected and SS
            $assigned->push(['Address'=>$address, 'Driver'=>$drivers[$index], 'SS'=>$ssSelected]);
            //remove selected driver from the array
            unset($drivers[$index]);

        }

        return $assigned;
    }
}
