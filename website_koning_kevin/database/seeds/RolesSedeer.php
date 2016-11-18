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

        $roles = array('Begelijders trekvakatties', 'Belijdsvrijwilligers',
            'Beschikbaar voor alle vrijwilegers', 'Coordinatoren',
            'Instructeur', 'Koks', 'Nieuwe Vrijwilliger');
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
