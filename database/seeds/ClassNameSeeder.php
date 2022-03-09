<?php

use Illuminate\Database\Seeder;
use App\ClassName;
class ClassNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassName::create(["level_id"=>"1","name"=>"Year 1","alternate_name"=>"Class 1","year"=>"1"]);
        ClassName::create(["level_id"=>"1","name"=>"Year 2","alternate_name"=>"Class 2","year"=>"2"]);
        ClassName::create(["level_id"=>"1","name"=>"Year 3","alternate_name"=>"Class 3","year"=>"3"]);
        ClassName::create(["level_id"=>"2","name"=>"Year 4","alternate_name"=>"Class 4","year"=>"4"]);
        ClassName::create(["level_id"=>"2","name"=>"Year 5","alternate_name"=>"Class 5","year"=>"5"]);
        ClassName::create(["level_id"=>"2","name"=>"Year 6","alternate_name"=>"Class 6","year"=>"6"]);
        ClassName::create(["level_id"=>"3","name"=>"Year 7","alternate_name"=>"JHS 1","year"=>"7"]);
        ClassName::create(["level_id"=>"3","name"=>"Year 8","alternate_name"=>"JHS 2","year"=>"8"]);
        ClassName::create(["level_id"=>"3","name"=>"Year 9","alternate_name"=>"JHS 3","year"=>"9"]);
        ClassName::create(["level_id"=>"4","name"=>"Year 10","alternate_name"=>"SHS 1","year"=>"10"]);
        ClassName::create(["level_id"=>"4","name"=>"Year 11","alternate_name"=>"SHS 2","year"=>"11"]);
        ClassName::create(["level_id"=>"4","name"=>"Year 12","alternate_name"=>"SHS 3","year"=>"12"]);
    }
}
