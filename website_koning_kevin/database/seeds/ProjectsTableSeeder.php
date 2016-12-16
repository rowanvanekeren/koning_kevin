<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();
        DB::table('projects')->insert([
            'name' => 'Weekendje zee',
            'description' => 'We gaan een weekendje naar zee in het weekend van 22 januari.  We zoeken hiervoor een tiental vrijwilligers!',
            'address' => 'Kapelstraat 35',
            'city' => 'Knokke',
            'country' => 'België',
            'start' => '2017-01-22 07:00:00',
            'end' => '2017-01-23 19:00:00',
            'active' => 1,
            'image' => '1479853833weekendje_zee.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
