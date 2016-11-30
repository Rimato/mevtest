<?php

namespace Rimato\SqlMongo\base;

/**
 * Class LexemHandler
 * @package Rimato\SqlMongo\base
 */
class LexemHandler
{
    /** @var  array $lexems */
    private $lexems;

    /**
     * LexemHandler constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->lexems = $params['lexems'];
    }

    /**
     * @param $lexems
     * @param string $mongoClient
     */
    public function run($lexems, $mongoClient = '')
    {

        foreach ($this->lexems as $name => $lexem) {
            if (class_exists($lexem['classname'])) {
                $lexem = new $lexem['classname'];
                $lexem->handle($lexems[$name], $mongoClient);
            }
        }
    }
}