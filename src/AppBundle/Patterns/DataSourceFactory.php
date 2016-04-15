<?php


namespace AppBundle\Patterns;


use AppBundle\DataSources\OpenWeatherDataSource;
use Symfony\Component\DependencyInjection\Dump\Container;

class DataSourceFactory extends \PatternBase
{
    private $dataSources;

    const tokenSuffix = 'token';
    const openWeatherDataSourceName = 'openweatherservice';
    const googleWeatherDataSourceName = 'googleweatherservice';

    public function __construct(Container $container){
        parent::__construct($container);
        $this->setDataSources();

    }

    private function setDataSources(){
        $this->dataSources = $this->container->getParameter('weather.datasources');
    }

    public function createDataSource($dataSourceName)
    {
        $dataSourceName = strtolower($dataSourceName);
        
        switch($dataSourceName){

            case self::openWeatherDataSourceName:
                $token = $this->getToken($dataSourceName);
                return new OpenWeatherDataSource($token);

            case self::googleWeatherDataSourceName:
                $token = $this->getToken($dataSourceName);
                return new GoogleWeatherDataSource($token);

            default:
                $token = $this->getToken($dataSourceName);
                return new OpenWeatherDataSource($token);
        }


    }

    protected function getToken($dataSourceName){

        $token = $this->dataSources[$dataSourceName]['token'];

        if(!empty($token)){
            return $token;
        }
        else{
            Throw new \Exception('Token Not Retrieved');
        }

    }

}