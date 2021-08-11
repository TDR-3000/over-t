<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{
    StatesSeeder, 
    UsersSeeder,
    CategoriesTasksSeeder,
    TasksSeeder
};

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatesSeeder::class,
            UsersSeeder::class,
            CategoriesTasksSeeder::class,
            TasksSeeder::class
        ]);
    }
}
