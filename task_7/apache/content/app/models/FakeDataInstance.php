<?php

class FakeDataInstance
{
    public string $name;
    public string $weekday;
    public string $month;
    public string $city;
    public string $bloodType;

    
    public function __construct(string $name, string $weekday, string $month, string $city, string $bloodType)
    {
        $this->name = $name;
        $this->weekday = $weekday;
        $this->month = $month;
        $this->city = $city;
        $this->bloodType = $bloodType;
    }


}