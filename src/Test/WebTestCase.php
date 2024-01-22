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

use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as Base;

class WebTestCase extends Base
{
    use DoctrineTestTrait;
    use ServiceTestTrait;
    protected string $path = '/';
    protected KernelBrowser $browser;

    protected function getBrowser(): KernelBrowser
    {
        if (!isset($this->browser)) {
            $this->browser = self::createClient();
        }

        return $this->browser;
    }

    /**
     * createEntity.
     *
     * @param ObjectRepository<object> $objectRepository
     */
    protected function createEntity(ObjectRepository $objectRepository, int $i): object
    {
        throw new \RuntimeException('Define protected function createEntity(ObjectRepository $objectRepository, int $i): object');
    }
}
