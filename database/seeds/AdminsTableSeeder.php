<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Entities\Admin::create([
            'email' => 'a@b.c',
            'first_name' => 'Gilad',
            'last_name' => 'Much',
            'phone' => '0548343311',
            'password' => bcrypt(123),
        ]);

        \App\Models\Entities\Admin::create([
            'email' => 'compie@compie.co.il',
            'first_name' => 'Compie',
            'last_name' => 'Tech',
            'phone' => '156468464',
            'password' => bcrypt(770770),
        ]);
    }
}
