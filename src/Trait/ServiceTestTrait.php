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

namespace Mazarini\Test\Trait;

use Symfony\Component\DependencyInjection\ContainerInterface;

trait ServiceTestTrait
{
    /**
     * @var array<string,''>
     */
    private array $nullServices = [];

    protected function addNullService(string $name): static
    {
        $this->nullServices[$name] = '';

        return $this;
    }

    /**
     * getService.
     *
     * @param 0|1|2|3|4 $invalidBehavior
     */
    protected function getService(string $name, int $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE): ?object
    {
        if (isset($this->nullServices[$name])) {
            unset($this->nullServices[$name]);

            return null;
        }

        $object = $this->getContainer()->get($name, $invalidBehavior);
        if (\is_object($object)) {
            return $object;
        }
        throw new \RuntimeException(sprintf('%s not found in container', $name));
    }
}
