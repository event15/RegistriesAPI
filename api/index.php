<?php
use Silex\Application;

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../app/config/bootstrap.php';



/** @var \Doctrine\ORM\EntityManager $em */
$em = $app[ 'orm.em' ];

$app->mount('/v0.1', new API\Provider());
$app->run();