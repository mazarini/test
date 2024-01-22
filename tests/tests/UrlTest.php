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

namespace App\Test\Controller;

use Mazarini\Test\Test\UrlTestCase;

class UrlTest extends UrlTestCase
{
    protected string $path = '/';

    /**
     * urlProvider.
     *
     * @return \Iterator<array<string|int>>
     */
    protected function urlProvider(): \Iterator
    {
        yield ['new', 200, 'GET'];
        yield ['302', 302, 'GET'];
    }
}
