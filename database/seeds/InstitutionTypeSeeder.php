<?php

use Illuminate\Database\Seeder;
use App\InstitutionType;
class InstitutionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstitutionType::create(["name"=>"School"]);
        InstitutionType::create(["name"=>"Church"]);
        InstitutionType::create(["name"=>"Pharmacy"]);
    }
}
