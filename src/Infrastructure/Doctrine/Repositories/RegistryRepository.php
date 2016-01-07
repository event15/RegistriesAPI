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
        } catch (ORMException $saveError) {
            sprintf('Nastąpił błąd przy dodawaniu samochodu: %s', $saveError);
        } catch (ORMInvalidArgumentException $argumentError) {
            sprintf('Błąd argumentu przy dodawaniu samochodu: %s', $argumentError);
        }
    }

    /**
     * @param $carId
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Car
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     * @throws \Exception
     */
    public function find($carId)
    {
        $car = $this->em->getRepository('Madkom\\RegistryApplication\\Domain\\CarManagement\\Car')
                        ->find($carId);

        if($car) {
            return $car;
        } else {
            throw new \Exception('Wybrany element nie istnieje.');
        }
    }

    /**
     * @return boolean
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     * @throws \Exception
     */
    public function remove($carId)
    {
        $car = self::find($carId);

        try {
            $this->em->remove($car);
            $this->em->flush();

        } catch (ORMException $saveError) {
            sprintf('Nastąpił błąd przy usuwaniu samochodu: %s', $saveError);
        } catch (ORMInvalidArgumentException $argumentError) {
            sprintf('Błąd argumentu przy usuwaniu samochodu: %s', $argumentError);
        }
    }
}
