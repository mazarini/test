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

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Mazarini\Test\Exception\TestContainerException;
use Mazarini\Test\Test\DoctrineTestCase;

class DoctrineTest extends DoctrineTestCase
{
    public function testObjectManagerNotExists(): void
    {
        $this->addNullService('doctrine');
        $this->expectException(TestContainerException::class);
        $this->assertInstanceOf(ObjectManager::class, $this->getObjectManager());
    }

    public function testObjectManagerExists(): void
    {
        $this->assertInstanceOf(ObjectManager::class, $this->getObjectManager());
        $this->assertInstanceOf(ObjectManager::class, $this->getObjectManager());
    }

    public function testRepository(): void
    {
        $this->assertInstanceOf(ArticleRepository::class, $this->getRepository(Article::class));
    }

    public function testEntity(): void
    {
        $repository = $this->getRepository(Article::class);
        $this->setFlushMax(7);
        $this->createEntities($repository, 9);
        $this->assertSame(9, $this->countEntity($repository));
        $this->removeEntities($repository);
        $this->assertSame(0, $this->countEntity($repository));
    }

    /**
     * createEntity.
     *
     * @param ArticleRepository $objectRepository
     *
     * @return Article
     */
    protected function createEntity(ObjectRepository $objectRepository, int $i): object
    {
        return (new Article())->setLabel(sprintf('Label %s', $i));
    }
}
