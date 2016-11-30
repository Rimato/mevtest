<?php

namespace Rimato\SqlMongo\lexems;

use Rimato\SqlMongo\base\MongoClient;

class FromLexem extends AbstractLexem
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
        $value = trim($value);
        $mongoclient->setCollection($value);
    }
}