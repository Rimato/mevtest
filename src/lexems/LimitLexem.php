<?php

namespace Rimato\SqlMongo\lexems;


class LimitLexem extends AbstractLexem
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
        $mongoclient->setLimit(intval($value));
    }

}