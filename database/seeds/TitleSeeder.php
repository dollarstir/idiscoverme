<?php

use Illuminate\Database\Seeder;

use App\Title;
class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Title::create(["name"=>"Mr"]);
        Title::create(["name"=>"Mrs"]);
        Title::create(["name"=>"Prof"]);
    }
}
