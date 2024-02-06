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

use Mazarini\Test\Exception\TestContainerException;
use Twig\Environment;

trait TwigTestTrait
{
    /**
     * render.
     *
     * @param array<string,mixed> $context
     */
    protected function render(string $template, array $context): string
    {
        return trim($this->getEnvironment()->render($template, $context));
    }

    protected function getEnvironment(): Environment
    {
        $object = $this->getService(Environment::class);

        if ($object instanceof Environment) {
            return $object;
        }
        throw new TestContainerException(Environment::class, $object ? $object::class : 'NULL');
    }
}
