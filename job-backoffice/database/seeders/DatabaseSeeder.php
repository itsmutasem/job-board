<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the root admin
        User::firstOrCreate([
            'email' => 'admin@admin.coom',
        ],[
            'name' => 'Admin',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Seed Data to test with
        $jobData = json_decode(file_get_contents(database_path('data/job_data.json')), true);
        $jobApplications = json_decode(file_get_contents(database_path('data/job_applications.json')), true);

        // Create Job Categories
        foreach ($jobData['jobCategories'] as $category) {
            JobCategory::firstOrCreate([
                'name' => $category
            ]);
        }

        // Create Companies
        foreach ($jobData['companies'] as $company) {
            // Create company owner
            $companyOwner = User::firstOrCreate([
                'email' => fake()->unique()->safeEmail(),
            ],[
                'name' => fake()->name,
                'password' => Hash::make('123456789'),
                'role' => 'company-owner',
                'email_verified_at' => now()
            ]);
            // Create company
            Company::firstOrCreate([
                'name' => $company['name']
            ],[
               'address' => $company['address'],
               'industry' => $company['industry'],
               'website' => $company['website'],
                'ownerId' => $companyOwner->id,
            ]);
        }

        // Create Job Vacancies
        foreach ($jobData['jobVacancies'] as $job) {
            // Get the created company
            $company = Company::where('name', $job['company'])->firstOrFail();

            // Get the created category
            $category = JobCategory::where('name', $job['category'])->firstOrFail();

            JobVacancy::firstOrCreate([
                'title' => $job['title'],
                'companyId' => $company->id,
            ],[
                'description' => $job['description'],
                'location' => $job['location'],
                'type' => $job['type'],
                'salary' => $job['salary'],
                'JobCategoryId' => $category->id,
            ]);

            // Create Job Applications (part 1)
            foreach ($jobApplications['jobApplications'] as $application) {
                // Get random job vacancy
                $jobVacancy = JobVacancy::inRandomOrder()->first();

                // Create applicant (job-seeker)
                $applicant = User::firstOrCreate([
                    'email' => fake()->unique()->safeEmail()
                ],[
                    'name' => fake()->name(),
                    'password' => Hash::make('123456789'),
                    'role' => 'job-seeker',
                    'email_verified_at' => now(),
                ]);

                // Create Resume
                $resume = Resume::create([
                    'userId' => $applicant->id,
                    'filename' => $application['resume']['filename'],
                    'fileUri' => $application['resume']['fileUri'],
                    'contactDetails' => $application['resume']['contactDetails'],
                    'summary' => $application['resume']['summary'],
                    'skills' => $application['resume']['skills'],
                    'experience' => $application['resume']['experience'],
                    'education' => $application['resume']['education'],
                ]);

            }
        }
    }
}
