<?php

namespace AppBundle\DataSources\Base;

abstract class DataSourceBase
{
    protected $city;
    protected $date;
    protected $weather;
    protected $language;
    protected $metric;
    protected $token;

    public function __construct($token){
        $this->token = $token;
    }

}