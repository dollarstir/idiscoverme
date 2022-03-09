<?php

use Illuminate\Database\Seeder;
use App\MarkingScheme;
class MarkingSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarkingScheme::create(["level_id"=>"1","institution_institution_id"=>"ICC-501896","class_score"=>"50","exams_score"=>"50"]);
    }
}
