<?php

namespace Rimato\SqlMongo\base;

/**
 * Class Parser
 * @package Rimato\SqlMongo\base
 */
class Parser
{
    /** @var  array $lexems */
    private $lexems;

    /**
     * @param array $lexems
     */
    public function setLexem($lexems)
    {
        $this->lexems = $lexems;
    }

    public function getLexems()
    {
        return $this->lexems;
    }

    /**
     * @param $query
     * @return array [$key=> $value] where $key - name of lexem(for example 'select'), $value - value
     * @throws \Exception
     */
    public function parseQuery($query)
    {
        $lexems = array_reverse($this->getLexems());
        $return = [];

        foreach ($lexems as $lexem) {
            if (preg_match('/('.$lexem.'(.*))$/i', $query, $res)) {
                $query = str_replace($res[1], '', $query);
                $return[$lexem]    = $res[2];
            }
        }
        return $return;
        throw new \Exception('invalid query');
    }
}