<?php


namespace AppBundle\Services\Base\Interfaces;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

interface IWeatherService
{
    function getWeather(ParameterBag $request);
}