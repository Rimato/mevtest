<?php

namespace Rimato\SqlMongo\base;

/**
 * Class MongoClient
 * @package Rimato\SqlMongo\base
 */
class MongoClient
{
    /** @var \MongoDB connection */
    private $connection;

    /** @var  array $_findFields */
    private $findFields;

    /** @var  string $_collection */
    private $collection;

    /** @var  array $_condition */
    private $condition;

    /** @var  array $_groupByFields */
    private $groupByFields;

    /** @var  array $_order */
    private $order = [];

    private $skip;

    private $limit;

    /**
     * MongoClient constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $conn = new \MongoClient($params['host']);
        $db = $conn->$params['dbname'];
        $this->_connection = $db;
    }

    /**
     * @param array $findFields
     */
    public function setFindFields($findFields)
    {
        $this->findFields = $findFields;
    }

    /**
     * @return array
     */
    public function getFindFields()
    {
        return $this->findFields;
    }

    /**
     * @param $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return array
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param $fields
     */
    public function setGroupByFields($fields)
    {
        $this->groupByFields = $fields;
    }

    /**
     * @return array
     */
    public function getGroupByFields()
    {
        return $this->groupByFields;
    }

    /**
     * @param array $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param $skip
     */
    public function setSkip($skip)
    {
        $this->skip = $skip;
    }

    /**
     * @return mixed
     */
    public function getSkip()
    {
        return $this->skip;
    }



    public function compile()
    {
        $db = $this->_connection;
        $collection = $this->getCollection();
        $collection = $db->$collection;
        $cursor = $collection->find($this->getCondition());
        if ($this->getLimit()) {
            $cursor->limit($this->getLimit());
        }
        if ($this->getSkip()) {
            $cursor->skip($this->getSkip());
        }
        $cursor->sort($this->getOrder());
        $i = 0;
        foreach ($cursor as $obj) {
            $i++;
            var_dump($obj);
        }
        echo  $i;
    }



}