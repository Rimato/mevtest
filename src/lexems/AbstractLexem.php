<?php

namespace Rimato\SqlMongo\lexems;

/**
 * Class AbstractLexem
 * @package Rimato\SqlMongo\lexems
 */
abstract class AbstractLexem
{
    abstract public function handle($value, $mongoclient);

    abstract public function validate();
}