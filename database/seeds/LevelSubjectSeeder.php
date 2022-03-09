<?php

use Illuminate\Database\Seeder;
use App\LevelSubject;
class LevelSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LevelSubject::create(["level_id"=>"1","subject_id"=>"12"]);
        LevelSubject::create(["level_id"=>"1","subject_id"=>"14"]);
        LevelSubject::create(["level_id"=>"1","subject_id"=>"11"]);
        LevelSubject::create(["level_id"=>"1","subject_id"=>"9"]);
        LevelSubject::create(["level_id"=>"1","subject_id"=>"8"]);

        LevelSubject::create(["level_id"=>"2","subject_id"=>"11"]);
        LevelSubject::create(["level_id"=>"2","subject_id"=>"9"]);
        LevelSubject::create(["level_id"=>"2","subject_id"=>"8"]);
        LevelSubject::create(["level_id"=>"2","subject_id"=>"13"]);

        LevelSubject::create(["level_id"=>"3","subject_id"=>"11"]);
        LevelSubject::create(["level_id"=>"3","subject_id"=>"9"]);
        LevelSubject::create(["level_id"=>"3","subject_id"=>"10"]);
        
    }
}
