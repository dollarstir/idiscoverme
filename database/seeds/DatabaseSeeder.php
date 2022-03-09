<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(RegionSeeder::class);
       $this->call(DistrictSeeder::class);
       $this->call(TitleSeeder::class);
       $this->call(InstitutionTypeSeeder::class);
       $this->call(PermissionSeeder::class);
       $this->call(LevelSeeder::class);
       $this->call(ClassNameSeeder::class);
       $this->call(SubjectSeeder::class);
       $this->call(LevelSubjectSeeder::class);
       $this->call(MarkingSchemeSeeder::class);
    
        
    }
}
