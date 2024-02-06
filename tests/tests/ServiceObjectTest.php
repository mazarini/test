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

namespace App\Tests;

use App\Service\ObjectService;
use Mazarini\Test\Exception\TestContainerException;
use Mazarini\Test\TestCase\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceObjectTest extends KernelTestCase
{
    public function testObjectExists(): void
    {
        $this->assertInstanceOf(ObjectService::class, $this->getObjectService());
    }

    public function testObjectNotExists(): void
    {
        $this->addNullService(ObjectService::class);
        $this->expectException(TestContainerException::class);
        $this->assertInstanceOf(ObjectService::class, $this->getObjectService());
    }

    public function testAliasNotExists(): void
    {
        $this->expectExceptionMessage('X not found in container');
        $this->assertInstanceOf(ObjectService::class, $this->getService('X', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    private function getObjectService(): ObjectService
    {
        $object = $this->getService(ObjectService::class);

        if ($object instanceof ObjectService) {
            return $object;
        }
        throw new TestContainerException(ObjectService::class, $object ? $object::class : 'NULL');
    }
}
