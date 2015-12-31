<?php
error_reporting(E_ALL | E_STRICT);
require_once __DIR__. '/../../vendor/autoload.php';

use Silex\Provider\DoctrineServiceProvider;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = new Silex\Application();
$app[ 'debug' ] = true;

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'charset' => 'utf8',
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'mistrz'
    )
));

$app->register(new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'yml',
                'namespace' => '\Models',
                'path' => array(__DIR__ . '/../src/Infrastructure/Doctrine/Mappings'),
            )
        )
    )
));

$config = Setup::createYAMLMetadataConfiguration($app['orm.em.options']['mappings'][0]['path'], $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);
