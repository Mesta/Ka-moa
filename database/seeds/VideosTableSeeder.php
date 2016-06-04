<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Video::class, 19)->create();
        DB::table('videos')->insert([
           'title'          => 'The Big Lebowsky',
           'date'           => '1998-06-03 00:00:00',
           'realisator'     => 'Frères Coen',
        ]);
    }
}
