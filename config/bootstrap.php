<?php
error_reporting(E_ALL | E_STRICT);
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Silex\Provider\DoctrineServiceProvider;
use Infrastructure\Doctrine\Repositories\RegistryRepository;

$app          = new Silex\Application();
$app['debug'] = true;

$app->register(new DoctrineServiceProvider(),
               [
                   'db.options' => [
                       'driver'   => 'pdo_mysql',
                       'charset'  => 'utf8',
                       'host'     => 'localhost',
                       'user'     => 'root',
                       'password' => 'root',
                       'dbname'   => 'mistrz'
                   ]
               ]
);

$app->register(
    new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),
   [
       'orm.em.options' => [
           'mappings' => [
               [
                   'type'      => 'yml',
                   'namespace' => 'Madkom\RegistryApplication\Domain',
                   'path'      => [__DIR__ . '/../src/Infrastructure/Doctrine/Mappings'],
               ]
           ]
       ]
   ]
);

$config        = Setup::createYAMLMetadataConfiguration($app['orm.em.options']['mappings'][0]['path'], $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);

$app['repositories.car'] = new RegistryRepository($app['orm.em']);
