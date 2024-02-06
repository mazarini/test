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

trait ReflectionTestTrait
{
    public function getProperty(object $object, string $property): mixed
    {
        return (new \ReflectionClass($object::class))
            ->getProperty($property)
            ->getValue($object)
        ;
    }

    public function setProperty(object $object, string $property, mixed $value): static
    {
        (new \ReflectionClass($object::class))
            ->getProperty($property)
            ->setValue($object, $value)
        ;

        return $this;
    }
}
