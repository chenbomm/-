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
        $database=file_get_contents(base_path('database/seeds')."/region.sql");

        DB::connection()->getPdo()->exec($database);
    }
}
