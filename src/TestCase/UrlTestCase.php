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

namespace Mazarini\Test\TestCase;

abstract class UrlTestCase extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testUrl(string $path, int $code = 200, string $method = 'GET'): void
    {
        $this->getBrowser()
            ->request($method, $this->path.$path)
        ;
        $this->assertResponseStatusCodeSame($code);
    }

    /**
     * urlProvider.
     *
     * @return \Iterator<array{0:string,1?:int,2?:string}>
     */
    abstract protected function urlProvider(): \Iterator;
}
