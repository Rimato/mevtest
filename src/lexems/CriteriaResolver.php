<?php

namespace Rimato\SqlMongo\lexems;

/**
 * Class CriteriaResolver
 * @package Rimato\SqlMongo\lexems
 */
class CriteriaResolver
{


    private $comparisonOperators = [
        '=' => '$eq',
        '>' => '$gt',
        '>=' => 'gte',
        '<' => '$lt',
        '<=' => '$lte',
        '<>' => '$ne'
    ];

    private $logicalOperators = [
        'and' => '$and',
        'or' => '$or'
    ];

    /** @var  string  */
    private $criteria;

    /** @var  array $preparedCriteriasArray */
    private $preparedCriteriasArray;

    /** @var  string */
    private $criteriaPattern;

    /**
     * CriteriaResolver constructor.
     * @param $preparedArray
     * @param $criteriaPattern
     */
    public function __construct($preparedArray, $criteriaPattern)
    {
        $this->_criteriaPattern = $criteriaPattern;
        $this->preparedCriteriasArray = $preparedArray;
    }

    /**
     * @param $string
     * @return array
     */
    public function resolve($string)
    {
        return $this->resolveOperation($string);
    }

    public function resolveOperation($string)
    {
        $string = (preg_replace('/\s{2,}/', ' ', $string));
        $string = preg_replace('/^\(/', '', $string);
        $string = preg_replace('/\)$/', '', $string);
        $string = ($string);
        $string = trim($string);

        $array = explode(' ', $string);

        if (count($array) == 1) {
            return $this->resolveOperation($this->preparedCriteriasArray[$array[0]]);
        }

        $operator = $array[1];
        if (isset($this->comparisonOperators[$operator])) {
            if ($operator === '=') {
                return [$array[0] => $array[2]];
            }
            $res = [
                $array[0] => [
                    $this->comparisonOperators[$operator] => floatval($array[2])
                ]
            ];
            return $res;

        } elseif (isset($this->logicalOperators[$operator])) {
            $items = explode($operator, $string);
            $array = [];
            foreach ($items as $item) {
                if (preg_match($this->_criteriaPattern, $item, $res)) {
                    $array[] = $this->resolveOperation($this->preparedCriteriasArray[$res[0]]);
                }
            }
            return [$this->logicalOperators[$operator] => $array];

        }
    }

}