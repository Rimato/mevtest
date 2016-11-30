<?php

namespace Rimato\SqlMongo\lexems;

use Rimato\SqlMongo\base\MongoClient;
/**
 * Class WhereLexem
 * @package Rimato\SqlMongo\lexems
 */
class WhereLexem extends AbstractLexem
{
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    private $criterias = [];

    /**
     * @param $value
     * @param MongoClient $mongoclient
     */
    public function handle($value, $mongoclient)
    {
        $string = $this->prepare($value);
        $resolver = new CriteriaResolver($this->criterias, '/#criteria\d{1,2}#/');
        $mongoclient->setCondition($resolver->resolve($string));
    }

    private function prepare($value)
    {
        $res = [];
        if (preg_match_all('/\([\w\s\d=<>\.\#]*?\)/', $value, $res)) {
            foreach ($res[0] as $item) {
                $num = count($this->criterias);
                $criterianame = '#criteria' . $num . '#';
                $this->criterias[$criterianame] = $item;
                $value = str_replace($item, $criterianame, $value);
            }
            return $this->prepare($value);
        }
        return $value;
    }


}