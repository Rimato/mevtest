<?php

namespace Rimato\SqlMongo\base;

/**
 * Class Application
 * @package Rimato\SqlMongo\base
 */
class Application
{
    /** @var  array $_config */
    private $_config;

    /** @var  Parser $_parser*/
    private $_parser;

    /** @var  LexemHandler $_lexemHandler */
    private $_lexemHandler;

    /** @var MongoClient $_mongoClient */
    private $_mongoClient;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->_config = $config;
        $this->_parser =  $this->getServiceByConfig('parser');
        $this->_parser->setLexem(array_keys($this->_config['services']["lexemHandler"]['params']['lexems']));
        $this->_lexemHandler = $this->getServiceByConfig('lexemHandler');
        $this->_mongoClient = $this->getServiceByConfig('mongoClient');
    }

    /**
     * @param $query
     */
    public function run($query)
    {
        $lexems = $this->_parser->parseQuery($query);
        $this->_lexemHandler->run($lexems, $this->_mongoClient);
        $this->_mongoClient->compile();

    }

    /**
     * @param string $serviceName
     * @return mixed
     * @throws \Exception
     */
    private function getServiceByConfig($serviceName)
    {
        $serviceConfig =  isset($this->_config['services'][$serviceName]) ? $this->_config['services'][$serviceName] : false;

        if($serviceConfig['classname']){
            if (class_exists($serviceConfig['classname'])){
                $params = isset($serviceConfig['params']) ? $serviceConfig['params']  : false;
                return new $serviceConfig['classname']($params);
            }
            throw new \Exception('Invalid service class ' . $serviceConfig['classname']);
        }
        else {
            throw new \Exception('Service '. $serviceName . ' not found ' );
        }
    }
}