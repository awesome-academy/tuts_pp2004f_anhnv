<?php

use Illuminate\Database\Seeder;

class PostStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PostStaff::class, 50)->create();
    }
}
