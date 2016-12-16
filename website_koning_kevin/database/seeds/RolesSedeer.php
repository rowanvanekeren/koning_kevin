<?php

use Illuminate\Database\Seeder;

class RolesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = array('Algemene info','Begeleider', 'Coördinator',
            'Koks', 'Stagiair animator',
            'Stagiair hoofdanimator', 'Lid Algemene vergadering', 'Lid Stuurgroep',
            'Lid Raad van bestuur','Instructeur Kadervorming','Instructeur Vorming op Aanvraag',
            'Chauffeur','Logistiek','Promo','Projectvrijwilliger','Lid team internationaal',
            'Lid vormingsteam','Lid eerstelijnsteam');



        foreach ($roles as $role) {
            $role_row =
                array(
                    'type' => $role,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                );
            DB::table('roles')->insert($role_row);
        }

        


    }
}
