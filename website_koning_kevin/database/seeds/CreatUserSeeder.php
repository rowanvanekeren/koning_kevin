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
                'first_name' => 'anotn',
                'last_name' => 'Patokin',
                'address' => 'Amerecalei 7',
                'city' => 'antwerpen',
                'country' => 'belgie',
                'job' => 'kok',
                'job_function' => 'kok',
                'gender' => 'man',
                'birth_date' => \Carbon\Carbon::now(),
                'birth_place' => 'Oezbekistan',
                'url' => '',
                'is_active' => 1,
                'is_admin' => 1,
                'email' => 'paraplu@list.ru',
                'password' => Hash::make(123456),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            );
        DB::table('users')->insert($user_row);

    }
}
