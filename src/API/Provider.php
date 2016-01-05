<?php
namespace API;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class Provider implements ControllerProviderInterface
{
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

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $controller->post(
            '/',
            'API\\Controllers\\RegistryController::add'
        );
        
        $controller->get(
            '/',
            'API\\Controllers\\RegistryController::add'
        );

        $controller->get(
            '/{id}',
            'API\\Controllers\\RegistryController::findRegistryById'
        );

        $controller->put(
            '/{id}',
            'API\\Controllers\\RegistryController::modifyRegistryById'
        )->value('id', 1);

        $controller->delete(
            '/{id}',
            'API\\Controllers\\RegistryController::deleteRegistryById'
        );

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $controller;
    }
}