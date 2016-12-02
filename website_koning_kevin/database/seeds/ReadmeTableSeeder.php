<?php

use Illuminate\Database\Seeder;

class ReadmeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('readmes')->delete();
        $readme_row =
            array(
                'url' => '/readme.pdf',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('readmes')->insert($readme_row);
    }
}
