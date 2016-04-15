<?php

namespace AppBundle\DataSources;

use AppBundle\DataSources\Base\DataSourceBase;
use AppBundle\DataSources\Base\Interfaces;
use Cmfcmf\OpenWeatherMap;

class GoogleWeatherDataSource extends DataSourceBase implements Interfaces\IDataSource {
    
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @param mixed $weather
     */
    public function setWeather($weather)
    {
        $this->weather = $weather;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * @param mixed $metric
     */
    public function setMetric($metric)
    {
        $this->metric = $metric;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param $language
     * @param $metric
     * @param $city
     * @param $date
     */
    function calculateWeather($language, $metric, $city, $date)
    {
        //TODO: Implement api call 
            
    }
}