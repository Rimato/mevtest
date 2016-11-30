<?php

namespace Rimato\SqlMongo\lexems;

/**
 * Class SkipLexem
 * @package Rimato\SqlMongo\lexems
 */
class SkipLexem extends AbstractLexem
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }


    /**
     * @param $value
     * @param MongoClient $mongoclient
     */
    public function handle($value, $mongoclient)
    {
        $mongoclient->setSkip(intval($value));
    }

}