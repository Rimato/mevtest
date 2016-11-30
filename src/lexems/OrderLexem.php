<?php

namespace Rimato\SqlMongo\lexems;

/**
 * Class OrderLexem
 * @package Rimato\SqlMongo\lexems
 */
class OrderLexem extends AbstractLexem
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }


    private $_index = [
        'ask' => 1,
        'desk' => -1
    ];

    /**
     * @param $value
     * @param MongoClient $mongoclient
     */
    public function handle($value, $mongoclient)
    {
        $value = trim($value);
        $value = explode(' ', $value);
        $value = array_map('trim', $value);
        $sort = trim(end($value));
        $result = [];
        if (isset($this->_index[$sort])) {
            for ($i = 1; $i < count($value)-1; $i++) {
                $result[$value[$i]] = $this->_index[$sort];
            }
        }
        $mongoclient->setOrder($result);
    }

}