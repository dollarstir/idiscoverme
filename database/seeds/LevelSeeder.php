<?php

use Illuminate\Database\Seeder;
use App\Level;
class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create(["name"=>"Basic School (Lower)"]);
        Level::create(["name"=>"Basic School (Upper)"]);
        Level::create(["name"=>"Junior High School"]);
        Level::create(["name"=>"Senior High School"]);
    }
}
