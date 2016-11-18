<?php

use Illuminate\Database\Seeder;

class CategorysSedeer extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        $categorys = array('EHBT(Eerste hulp)','Voorbeeldbrieven','Lijst met eventuele locaties','av','RvB','Stuurgroep','Koken bij koning kevin');

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
