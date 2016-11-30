<?php

namespace Rimato\SqlMongo\lexems;

use Rimato\SqlMongo\base\MongoClient;

class GroupLexem extends AbstractLexem
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
        $value = explode(' ', $value);
        $value = array_map('trim', $value);
        $value = array_slice($value, 1);
        $mongoclient->setGroupByFields($value);
    }
}