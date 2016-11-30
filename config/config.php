<?php

return [
    'services' => [
        'lexemHandler' => [
            'classname' => 'Rimato\SqlMongo\base\LexemHandler',
            'params' => [
                'lexems' => [
                    'select' => [
                        'classname' => 'Rimato\SqlMongo\lexems\SelectLexem',
                        'required' => true,
                    ],
                    'from' => [
                        'classname' => 'Rimato\SqlMongo\lexems\FromLexem',
                        'required' => true
                    ],
                    'where' => [
                        'classname' => 'Rimato\SqlMongo\lexems\WhereLexem',
                        'required' => true
                    ],
                    'group' => [
                        'classname' => 'Rimato\SqlMongo\lexems\GroupLexem',
                        'required' => false
                    ],
                    'order' => [
                        'classname' => 'Rimato\SqlMongo\lexems\OrderLexem',
                        'required' => false
                    ],
                    'skip' => [
                        'classname' => 'Rimato\SqlMongo\lexems\SkipLexem',
                        'required' => false
                    ],
                    'limit' => [
                        'classname' => 'Rimato\SqlMongo\lexems\LimitLexem',
                        'required' => false
                    ],
                ]
            ]
        ],
        'parser' => [
            'classname' => 'Rimato\SqlMongo\base\Parser'
        ],
        'mongoClient' => [
            'classname' => 'Rimato\SqlMongo\base\MongoClient',
            'params' => [
                'dbname' => 'test',
                'host' => 'localhost'
            ]
        ]
    ]
];