<?php
// cli-config.php
require_once 'config/bootstrap.php';
use Symfony\Component\Console\Helper\HelperSet;

$helperSet = new  HelperSet([
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app['orm.em']->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app['orm.em'])
]);

return $helperSet;
