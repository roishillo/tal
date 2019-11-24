<?php

use App\Models\Entities\Educand;
use Illuminate\Database\Seeder;

class EducandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Educand::class, 50)->create();

    }
}
