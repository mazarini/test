<?php

/*
 * Copyright (C) 2024 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/Test.
 *
 * mazarini/Test is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/Test is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace Mazarini\Test\Test;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Mazarini\Test\Exception\TestContainerException;

trait DoctrineTestTrait
{
    private ObjectManager $objectManager;
    private int $flushCounter = 0;
    private int $flushMax = 100;

    protected function autoFlush(object $object = null): static
    {
        if (null !== $object) {
            $this->getObjectManager()->persist($object);
        }
        ++$this->flushCounter;
        if ($this->flushCounter > $this->flushMax) {
            $this->getObjectManager()->flush();
            $this->flushCounter = 0;
        }

        return $this;
    }

    /**
     * countEntity.
     *
     * @param ObjectRepository<object> $objectRepository
     */
    protected function countEntity(ObjectRepository $objectRepository): int
    {
        return $objectRepository instanceof \Countable ? \count($objectRepository) : \count($objectRepository->findAll());
    }

    /**
     * create.
     *
     * @param ObjectRepository<object> $objectRepository
     */
    protected function createEntities(ObjectRepository $objectRepository, int $number): static
    {
        for ($i = 1; $i <= $number; ++$i) {
            $this->autoFlush($this->createEntity($objectRepository, $i));
        }
        $this->getObjectManager()->flush();

        return $this;
    }

    /**
     * remove.
     *
     * @param ObjectRepository<object> $objectRepository
     */
    protected function removeEntities(ObjectRepository $objectRepository): static
    {
        foreach ($objectRepository->findAll() as $entity) {
            $this->getObjectManager()->remove($entity);
            $this->autoFlush();
        }
        $this->getObjectManager()->flush();

        return $this;
    }

    /**
     * getRepository.
     *
     * @param class-string<object> $name
     *
     * @return ObjectRepository<object>
     */
    protected function getRepository(string $name): ObjectRepository
    {
        return $this->getObjectManager()->getRepository($name);
    }

    protected function getObjectManager(): ObjectManager
    {
        if (isset($this->objectManager)) {
            return $this->objectManager;
        }
        $object = $this->getService('doctrine');
        if ($object instanceof Registry) {
            return $this->objectManager = $object->getManager();
        }
        throw new TestContainerException(Registry::class, $object ? $object::class : 'NULL');
    }

    /**
     * Set the value of flushMax.
     */
    public function setFlushMax(int $flushMax): static
    {
        $this->flushMax = $flushMax;

        return $this;
    }
}
