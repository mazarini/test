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

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectRepository;
use Mazarini\Test\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    protected ArticleRepository $repository;

    protected function setUp(): void
    {
        $this->browser = $this->getBrowser();
        $repository = $this->getRepository(Article::class);
        if ($repository instanceof ArticleRepository) {
            $this->repository = $repository;
            $this->removeEntities($this->repository);
            $this->createEntities($this->repository, 1);
        }
    }

    public function testSetup(): void
    {
        $this->assertCount(1, $this->repository);
        $crawler = $this->browser->request('GET', $this->path.'302');
        $this->assertResponseRedirects($this->path.'new');
        $crawler = $this->browser->request('GET', $this->path.'new');
        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('1', $crawler->filter('#count')->text());
        $form = $crawler->selectButton('Save')->form();
        $form['article[label]'] = 'My label';
        $crawler = $this->browser->submit($form);
        $this->assertResponseRedirects($this->path.'new');
        $this->assertResponseRedirects($this->path.'new');
        $crawler = $this->browser->request('GET', $this->path.'new');
        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('2', $crawler->filter('#count')->text());
    }

    /*
    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'article[label]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }
    */
    /**
     * createEntity.
     *
     * @param ObjectRepository<object> $objectRepository
     */
    protected function createEntity(ObjectRepository $objectRepository, int $i): object
    {
        return (new Article())->setLabel(sprintf('Label %s', $i));
    }
}
