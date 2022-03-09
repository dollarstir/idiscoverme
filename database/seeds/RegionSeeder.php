<?php
use App\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(["name"=>"Ashanti"]);
        Region::create(["name"=>"Brong Ahafo"]);
        Region::create(["name"=>"Central"]);
        Region::create(["name"=>"Eastern"]);
        Region::create(["name"=>"Greater Accra"]);
        Region::create(["name"=>"Northern"]);
        Region::create(["name"=>"Upper East"]);
        Region::create(["name"=>"Upper West"]);
        Region::create(["name"=>"Volta"]);
        Region::create(["name"=>"Western"]);
    }
}
