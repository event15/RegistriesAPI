<?php

namespace Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Madkom\RegistryApplication\Domain\CarManagement\Car;
use Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface;

class RegistryRepository implements CarRepositoryInterface
{

    private $em;

    /**
    * @param \Doctrine\ORM\EntityManager $entityManager
    */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param \Madkom\RegistryApplication\Domain\CarManagement\Car $car
     *
     * @return mixed
     */
    public function add(Car $car)
    {
        try {
            $this->em->persist($car);
            $this->em->flush();
        } catch(ORMException $saveError) {
            sprintf('Nastąpił błąd przy dodawaniu samochodu: %s', $saveError);
        } catch(ORMInvalidArgumentException $argumentError) {
            sprintf('Błąd argumentu przy dodawaniu samochodu: %s', $argumentError);
        }
    }

    /**
     * @param $carId
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Car
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     */
    public function find($carId)
    {
        return $this->em->getRepository();
    }

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
    }

    /**
     * @return boolean
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     */
    public function remove($carId)
    {
        // TODO: Implement remove() method.
    }

    public function getAllPositions()
    {
        // TODO: Implement getAllPositions() method.
    }
}
