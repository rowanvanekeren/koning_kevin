<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CategorysSedeer::class);
        $this->call(RolesSedeer::class);
        $this->call(CreatUserSeeder::class);
        $this->call(CreatDocumentSeeder::class);
        $this->call(TagsSeeder::class);
      
    }
}
