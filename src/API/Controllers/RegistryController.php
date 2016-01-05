<?php

namespace API\Controllers;

use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\AddCarCommand;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistryController
{
    private $carRepository;

    public function add(Application $app, Request $request)
    {
        $dto = new CarDTO($request->get('id'),
                          $request->get('responsiblePerson'),
                          $request->get('model'),
                          $request->get('brand'),
                          $request->get('registrationNumber'),
                          $request->get('productionDate'),
                          $request->get('warrantyPeriod'),
                          $request->get('city'),
                          $request->get('department')
        );

        $newCar = new AddCarCommand($app['repositories.car'], $dto);
        $newCar->execute();

        return new Response('OK', 201);

    }

    public function remove() : void
    {

    }

    public function find()
    {

    }

    public function modify()
    {

    }
}
