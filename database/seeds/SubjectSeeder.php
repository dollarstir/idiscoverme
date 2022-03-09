<?php

use Illuminate\Database\Seeder;

use App\Subject;
class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(["name"=>"Physical Education","is_core"=>"1"]);
        Subject::create(["name"=>"English Language","is_core"=>"1"]);
        Subject::create(["name"=>"Core Mathematics","is_core"=>"1"]);
        Subject::create(["name"=>"Integrated Science","is_core"=>"1"]);
        Subject::create(["name"=>"Social Studies","is_core"=>"1"]);
        Subject::create(["name"=>"Religious & Moral Education","is_core"=>"1"]);
        Subject::create(["name"=>"Information and Communication Technology","is_core"=>"1"]);
        Subject::create(["name"=>"Music and Dance","is_core"=>"0"]);
        Subject::create(["name"=>"Ghanaian Language & Culture","is_core"=>"0"]);
        Subject::create(["name"=>"Basic Design & Technology","is_core"=>"0"]);
        Subject::create(["name"=>"French","is_core"=>"0"]);
        Subject::create(["name"=>"Natural Science","is_core"=>"0"]);
        Subject::create(["name"=>"Citizenship Education","is_core"=>"0"]);
        Subject::create(["name"=>"Art","is_core"=>"0"]);
        Subject::create(["name"=>"Physics","is_core"=>"0"]);
        Subject::create(["name"=>"Chemistry","is_core"=>"0"]);
        Subject::create(["name"=>"Biology","is_core"=>"0"]);
        Subject::create(["name"=>"Geography","is_core"=>"0"]);
        Subject::create(["name"=>"Elective Mathematics","is_core"=>"0"]);
    }
}
