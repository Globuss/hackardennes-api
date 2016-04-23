<?php

namespace AppBundle\Deployment;

/**
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class HerokuConfigurator
{
    public static function populateEnvironment()
    {
        $url = getenv("DATABASE_URL");

        if ($url) {
            $url = parse_url($url);
            $db  = substr($url['path'],1);

            putenv("DATABASE_HOST={$url['host']}");
            putenv("DATABASE_USER={$url['user']}");
            putenv("DATABASE_PASSWORD={$url['pass']}");
            putenv("DATABASE_PORT={$url['port']}");
            putenv("DATABASE_NAME={$db}");
            putenv("DATABASE_DRIVER=pdo_pgsql");
        }
    }
}
