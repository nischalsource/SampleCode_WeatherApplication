<?php

namespace AppBundle\Services;

use AppBundle\DataSources\Base\Interfaces;
use AppBundle\Services\Base;
use AppBundle\DataSources\Base\Interfaces as DataSourceInterfaces;
use AppBundle\Patterns;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation;


class WeatherService extends Base\ServiceBase implements IWeatherService
{


    /**
     * @var DataSourceInterfaces\IDataSource
     */
    protected $weatherDataSource;

    public function __construct(EntityManagerInterface $entityManager, Container $container, RequestStack $requestStack)
    {
        parent::__construct($entityManager, $container, $requestStack);
    }


    /**
     * Retrieves a datasource provider from our datasource factory
     *
     * @param $name
     * @return DataSourceInterfaces\IDataSource
     *
     */
    private function setWeatherDataSource($name){

        $dataSourceFactory = $this->container->get('weather.weather_datasourcefactory');
        $this->weatherDataSource = $dataSourceFactory->createDataSource($name);
        return $this->weatherDataSource;
    }


    /**
     * Retrieves Weather Data for a range of days using a single Weather Datasource as a provider
     * The method can handle requests of different languages, days, metric and cities
     */
    public function getWeather(ParameterBag $request)
    {
       $weatherData = array();
       $postData = $request->all();

       if (is_array($postData['request']) && count($postData['request'])) {
           $dataSourceName = $postData['datasource'];
           $requests = $postData['requests'];

           $this->setWeatherDataSource($dataSourceName);

           if (is_array($requests) && count($requests)) {
               foreach ($requests as $request) {
                   $language = $request['language'];
                   $metric = $request['metric'];
                   $city = $request['city'];
                   $date = $request['date'];

                   $data = $this->weatherDataSource->calculateWeather($language, $metric, $city, $date);
               
                   $weatherData[] = $data;
               }
           }
           
       };

        return weatherData;
    }

}