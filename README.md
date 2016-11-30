# mevtest
Requirements  
    PHP 5.6+
    Mongo 3+
    Linux, OSX
    
    
Usage

    $ cd Project
    $ php mongosql "select from items where ((quantity > 2) and (quantity < 5)) and (name = "bacon")"
    
Configuration
    config/config.php