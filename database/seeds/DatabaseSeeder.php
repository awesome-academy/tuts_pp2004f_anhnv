<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class)
            ->call(StaffSeeder::class)
            ->call(ProfileSeeder::class)
            ->call(CategorySeeder::class)
            ->call(PostSeeder::class)
            ->call(PostStaffSeeder::class)
            ->call(CommentSeeder::class);
    }
}
