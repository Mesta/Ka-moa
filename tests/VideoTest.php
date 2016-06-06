<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    /**
     * Test index with no parameter
     *
     * @return void
     */
    public function testIndex()
    {
        $this->json('GET', '/api/videos')
            ->seeJsonStructure([
                'videos' => [
                    '*' => ['title', 'date', 'realisator']
                ],
                'count'
            ]);
    }

    /**
     * Test index with realisator GET parameter
     *
     * @return void
     */
    public function testIndexRealisator()
    {
        $this->json('GET', '/api/videos?realisator=Frères%20Coen')
            ->seeJsonEquals([
                'videos' => [
                    [
                        'id'            => 20,
                        'title'         => 'The Big Lebowsky',
                        'date'          => '1998-06-03 00:00:00',
                        'realisator'    => 'Frères Coen'
                    ]
                ],
                'count' => 1
            ]);
    }

    /**
    * Test index with from GET parameter
    *
    * @return void
    */
    public function testIndexFrom()
    {
        $this->json('GET', '/api/videos?from=19000101')
        ->seeJsonStructure([
            'videos' => [
                '*' => ['title', 'date', 'realisator']
            ],
            'count'
        ]);
    }

    /**
     * Test index with to GET parameter
     *
     * @return void
     */
    public function testIndexTo()
    {
        $this->json('GET', '/api/videos?to=20170101')
            ->seeJsonStructure([
                'videos' => [
                    '*' => ['title', 'date', 'realisator']
                ],
                'count'
            ]);
    }

    /**
     * Test index with realisator GET parameter
     *
     * @return void
     */
    public function testIndexBetween()
    {
        // Test date to before from
        $this->json('GET', '/api/videos?from=19000101&to=20160101')
            ->seeJsonStructure([
                'videos' => [
                    '*' => ['title', 'date', 'realisator']
                ],
                'count'
            ]);

        // Test date to after from
        $this->json('GET', '/api/videos?from=20160101&to=19000101')
            ->seeJsonStructure([
                'videos' => [
                ],
                'count'
            ]);
    }

    /**
     * Test show with id parameter
     *
     * @return void
     */
    public function testShow()
    {
        $this->json('GET', '/api/videos/20')
            ->seeJsonEquals([
                'video' => [
                    'id'            => 20,
                    'title'         => 'The Big Lebowsky',
                    'date'          => '1998-06-03 00:00:00',
                    'realisator'    => 'Frères Coen'
                ],
            ]);
    }

    /**
     * Test video:create command
     *
     * @return void
     */
    public function testVideoCreate() {
        Artisan::queue('video:create', [
            'title'         => 'L\'homme qui murmurait à l\'oreille des cheveaux',
            'realisator'    => 'Robert Redford',
            'date'          => '1998-05-15 00:00:00',
            '--force'       => 'true'
        ]);

        $this->seeInDatabase('videos', ['title' => 'L\'homme qui murmurait à l\'oreille des cheveaux']);
    }
}
