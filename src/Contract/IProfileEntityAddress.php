<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntityAddress
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setCountry(string $country);
    public function getCountry():string;

    public function setState(string $state);
    public function getState():string;

    public function setCity(string $city);
    public function getCity():string;

    public function setZip(string $zip);
    public function getZip():string;

    public function setStreet(string $street);
    public function getStreet():string;

    public function setBuildingNumber(string $buildingNumber);
    public function getBuildingNumber():string;

    public function setDisplay(string $display);
    public function getDisplay():string;



}
