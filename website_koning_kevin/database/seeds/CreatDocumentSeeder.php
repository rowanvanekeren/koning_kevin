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
                'url' => 'feck_url.com',
                'priority'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('documents')->insert($documents_row);
    }
}
