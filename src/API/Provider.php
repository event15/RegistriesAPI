<?php
namespace API;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class Provider implements ControllerProviderInterface
{
    const CTRL = 'API\\Controllers\\RegistryController::';

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controller */
        $controller = $app['controllers_factory'];

        $controller->post('/car', self::CTRL . 'add');
        $controller->get('/car', self::CTRL . 'getAll');

        $controller->delete('/car/{id}', self::CTRL . 'remove')
            ->value('id', 1)->assert('id', '\d+');

        $controller->get('/car/{id}', self::CTRL . 'get')
                   ->value('id', 1)->assert('id', '\d+');
        $controller->put('/car/{id}', self::CTRL . 'modify')
                   ->value('id', 1)->assert('id', '\d+');

        return $controller;
    }
}