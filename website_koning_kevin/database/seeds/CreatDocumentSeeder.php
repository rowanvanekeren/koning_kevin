<?php

use Illuminate\Database\Seeder;

class CreatDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->delete();
        $documents_row =
            array(
                'title' => 'Test document',
                'description' => 'Er is url maar geen echte bestand ',
                'url' => 'https://docs.google.com/document/d/1rKZYXqCj2xa8fAmCuro91epDrQNcofLdglfs0lsBSFs/edit?usp=sharing',
                'priority'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('documents')->insert($documents_row);


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
