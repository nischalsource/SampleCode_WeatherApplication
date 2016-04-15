<?php

namespace AppBundle\DataSources\Base\Interfaces;


interface IDataSource
{
    function getCity();
    function setCity($city);

    function getDate();
    function setDate($date);

    function getWeather();
    function setWeather($weather);

    function getLanguage();
    function setLanguage($language);

    function getMetric();
    function setMetric($metric);

    function getToken();
    function setToken($token);

    function calculateWeather($language, $metric, $city, $date);




}