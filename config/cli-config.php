<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

return call_user_func(function (){
    /** @var \Interop\Container\ContainerInterface \$container */
    $container = require 'config/container.php';

    $entityManager = $container->get(\Doctrine\ORM\EntityManager::class);
    return ConsoleRunner::createHelperSet($entityManager);
});