<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        $tags = array('Song','Massive Attack','Voedingstoffen');
        foreach ($tags as $tag) {
            $tags_row =
                array(
                    'type' => $tag,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('tags')->insert($tags_row);
        }
        
    }
}
