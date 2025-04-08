<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use App\Models\IndividualCourse;
use App\Models\Schedule;
use App\Models\Assessment;
use App\Models\Teacher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'test',
        ]);


        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => 'test',
        ]);

        User::factory()->create([
            'first_name' => 'Teacher',
            'last_name' => 'User',
            'email' => 'adminteacher@example.com',
            'role' => 'admin',
            'password' => 'test',
        ]);

        Teacher::factory()->create([
            'user_id' => 3,
        ]);



        
        User::factory(10)->has(Tutor::factory())->create();
        User::factory(2)->has(Tutor::factory()->state([
            'subjects' => json_encode([0 => 'MCR3U1',  1 =>'MPM2D1'])
        ]))->create();

        $tutorUser = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'tutor@example.com',
            'password' =>'test', 
            'role' => 'tutor',
        ]);

        Tutor::factory()->create([
            'user_id' => $tutorUser->id,
            'subjects' => json_encode([0 => 'MHF4U1', 1 => 'SCH3U1']),
            'availability' => 'Monday to Friday, 9 AM to 5 PM',
        ]);


        Course::factory()->create([
            'code' => 'ICS3U6',
            'subject' => 'Computer Science',
            'type' => 'Advanced Placement',
            'grade' => 11,
        ]);

        Course::factory()->create([
            'code' => 'MHF4U1',
            'subject' => 'Calculus I',
            'type' => 'University',
            'grade' => 12,
        ]);

        Course::factory()->create([
            'code' => 'SCH4UE',
            'subject' => 'Chemistry',
            'type' => 'Advanced Placement',
            'grade' => 12,
            
        ]);

        IndividualCourse::factory()->create([
            'course_id' => 1,
            'grade' => 90,
            'final_mark' => 90,
            'midterm_mark' => 90,
        ]);

        IndividualCourse::factory()->create([
            'course_id' => 2,
            'grade' => 90,
            'final_mark' => 90,
            'midterm_mark' => 90,
        ]);

        Schedule::factory()->create([
            'user_id' => 1,
            'period_1_course_id' => 1,
            'period_2_course_id' => 2,
        ]);

        Assessment::factory()->create([
            'individual_course_id' => 1,
            'name' => 'Midterm',
            'feedback' => 'Good job!',
            'mark' => 90,
            'weight' => 50,
        ]);

        Assessment::factory()->create([
            'individual_course_id' => 1,
            'name' => 'Midterm 2',
            'feedback' => 'Good job!',
            'mark' => 92,
            'weight' => 80,
        ]);

    




        

    }
}
