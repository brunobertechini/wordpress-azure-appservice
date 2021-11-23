<?php

//
// Configure Redis Cache
//
$redis_host = '';
$redis_port = '6380';
$redis_password = '';
$redis_scheme = 'tls';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "CUSTOMCONNSTR_redis") !== 0) {
        continue;
    }
    
    $redis_host = preg_replace("/^.*Host=(.+?);.*$/", "\\1", $value);
    $redis_scheme = preg_replace("/^.*Scheme=(.+?);.*$/", "\\1", $value);
    $redis_port = preg_replace("/^.*Port=(.+?);.*$/", "\\1", $value);
    $redis_password = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

define( 'WP_REDIS_HOST', $redis_host );
define( 'WP_REDIS_PORT', $redis_port );
define( 'WP_REDIS_PASSWORD', $redis_password );
define( 'WP_REDIS_CLIENT', 'phpredis' );
define( 'WP_REDIS_TIMEOUT', 1 );
define( 'WP_REDIS_READ_TIMEOUT', 1 );
define( 'WP_REDIS_DATABASE', 0 );

echo "Redis Host: ", $redis_host, "\n<br/>";
echo "Redis Scheme: ", $redis_scheme, "\n<br/>";
echo "Redis Port: ", $redis_port, "\n<br/>";
echo "Redis Password: ", $redis_password, "\n<br/>";

?>