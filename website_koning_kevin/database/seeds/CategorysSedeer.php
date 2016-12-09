<?php

use Illuminate\Database\Seeder;

class CategorysSedeer extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        $categorys = array('PRAKTISCH: Veiligheid en preventie',
            'PRAKTISCH: Financiën en vergoeding',
            'PRAKTISCH: Locaties en vervoer',
            'PRAKTISCH: Materiaal',
            'PRAKTISCH: Organisatie op het initiatief',
            'INHOUDELIJK: Spel',
            'INHOUDELIJK: Speelse Kunsteducatie',
            'INHOUDELIJK: Begeleidershouding',
            'INHOUDELIJK: Specifieke initiatieven',
            'INHOUDELIJK: Organisatie op het initiatief',
            'INHOUDELIJK: Cursusbundels', 'VRIJWILLIGERSINFO',
            'BELEIDSINFO');


        foreach ($categorys as $category) {
            $category_rows =
                array(
                    'type' => $category,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('categories')->insert($category_rows);
        }
    }
}
