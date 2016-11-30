<?php

namespace Rimato\SqlMongo\lexems;

use Rimato\SqlMongo\base\MongoClient;

/**
 * Class SelectLexem
 * @package Rimato\SqlMongo\lexems
 */
class SelectLexem extends AbstractLexem
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
        $value = explode(',', $value);
        $value = array_map('trim', $value);
        $mongoclient->setFindFields($value);
    }

}