<?php

use Illuminate\Database\Seeder;

class CreatUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();


        $user_row =
            array(
                'first_name' => 'Anton',
                'last_name' => 'Patokin',
                'address' => 'Amerecalei 7',
                'city' => 'antwerpen',
                'country' => 'belgie',
                'job' => 'kok',
                'job_function' => 'kok',
                'gender' => 'man',
                'birth_date' => \Carbon\Carbon::now(),
                'birth_place' => 'Oezbekistan',
                'url' => 'profielfoto.jpg',
                'is_active' => 1,
                'is_admin' => 1,
                'email' => 'paraplu@list.ru',
                'readme' => 1,
                'password' => Hash::make(123456),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('users')->insert($user_row);

        $pivot_tabele = array(
            array(
                'role_id' => DB::table('roles')
                    ->where('type', '=', 'Algemene info')
                    ->select('id')->first()->id,

                'user_id' => DB::table('users')
                    ->where('first_name', '=', 'Anton')
                    ->select('id')->first()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            )
        );
        DB::table('role_user')->insert($pivot_tabele);
        
        $administrative_details = 
            array(
            'bank_account_number' => null,
            'national_insurance_number' => null,
            'identity_number' => null,
            'user_id' => DB::table('users')
                    ->where('first_name', '=', 'Anton')
                    ->select('id')->first()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
        );
        DB::table('admninistrative_details')->insert($administrative_details);

    }
}
