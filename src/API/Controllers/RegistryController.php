<?php

namespace API\Controllers;

use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\AddCarCommand;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\ModifyCarCommand;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\RemoveCarCommand;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistryController
{
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

    public function remove(Application $app, Request $request)
    {
        $removeCar = new RemoveCarCommand($app['repositories.car'], $request->get('id'));
        $removeCar->execute();

        return new Response('OK', 201);
    }

    public function getAll(Application $app)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $app['orm.em'];

        $query = $em->createQuery('SELECT c FROM Madkom\RegistryApplication\Domain\CarManagement\Car c');
        $result = $query->getArrayResult();

        return $app->json($result, 200);
    }

    public function get(Application $app, $id)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $app['orm.em'];

        $query = $em->createQuery('SELECT c FROM Madkom\RegistryApplication\Domain\CarManagement\Car c WHERE c.id = :id')
                    ->setParameter('id', $id);

        $result = $query->getArrayResult();

        return $app->json($result, 200);
    }

    public function modify(Application $app, Request $request, $id)
    {


        $command = new ModifyCarCommand($app['repositories.car'], $id, $dto);

        return new Response('OK', 200);
    }
}
