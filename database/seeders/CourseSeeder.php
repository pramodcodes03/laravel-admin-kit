<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Institute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $institutes = Institute::all()->keyBy('name');

        $courses = [
            [
                'institute'         => 'Genius Computer Institute',
                'title'             => 'Full Stack Web Development',
                'short_description' => 'Master HTML, CSS, JavaScript, React, Node.js and build real-world web applications.',
                'duration_weeks'    => 24,
                'hours_per_week'    => 12,
                'mode'              => ['Offline', 'Online'],
                'level'             => 'Beginner',
                'price_inr'         => 18000,
                'original_price_inr'=> 25000,
                'certificate'       => true,
                'placement_support' => true,
                'emi_available'     => true,
                'status'            => 'active',
            ],
            [
                'institute'         => 'Genius Computer Institute',
                'title'             => 'Tally Prime with GST',
                'short_description' => 'Complete accounting with Tally Prime, GST filing, and financial reporting.',
                'duration_weeks'    => 8,
                'hours_per_week'    => 8,
                'mode'              => ['Offline'],
                'level'             => 'Beginner',
                'price_inr'         => 5500,
                'original_price_inr'=> 7000,
                'certificate'       => true,
                'placement_support' => false,
                'emi_available'     => false,
                'status'            => 'active',
            ],
            [
                'institute'         => 'TechPro Academy',
                'title'             => 'Python Programming & Data Science',
                'short_description' => 'Learn Python from scratch and dive into data science, pandas, numpy, and machine learning basics.',
                'duration_weeks'    => 20,
                'hours_per_week'    => 10,
                'mode'              => ['Offline', 'Hybrid'],
                'level'             => 'Intermediate',
                'price_inr'         => 22000,
                'original_price_inr'=> 30000,
                'certificate'       => true,
                'placement_support' => true,
                'emi_available'     => true,
                'status'            => 'active',
            ],
            [
                'institute'         => 'TechPro Academy',
                'title'             => 'Graphic Design with Adobe Suite',
                'short_description' => 'Master Photoshop, Illustrator, and InDesign for professional graphic design.',
                'duration_weeks'    => 12,
                'hours_per_week'    => 8,
                'mode'              => ['Offline'],
                'level'             => 'Beginner',
                'price_inr'         => 12000,
                'original_price_inr'=> 16000,
                'certificate'       => true,
                'placement_support' => false,
                'emi_available'     => false,
                'status'            => 'active',
            ],
            [
                'institute'         => 'BrightMind Coaching Centre',
                'title'             => 'JEE Main & Advanced Preparation',
                'short_description' => 'Comprehensive coaching for IIT JEE with expert faculty, weekly tests, and doubt sessions.',
                'duration_weeks'    => 52,
                'hours_per_week'    => 20,
                'mode'              => ['Offline'],
                'level'             => 'Advanced',
                'price_inr'         => 85000,
                'original_price_inr'=> 100000,
                'certificate'       => false,
                'placement_support' => false,
                'emi_available'     => true,
                'status'            => 'active',
            ],
            [
                'institute'         => 'Digital Skills Hub',
                'title'             => 'Digital Marketing Mastery',
                'short_description' => 'SEO, Google Ads, Social Media Marketing, Email Marketing and analytics in one course.',
                'duration_weeks'    => 16,
                'hours_per_week'    => 10,
                'mode'              => ['Online', 'Hybrid'],
                'level'             => 'All Levels',
                'price_inr'         => 15000,
                'original_price_inr'=> 20000,
                'certificate'       => true,
                'placement_support' => true,
                'emi_available'     => false,
                'status'            => 'active',
            ],
            [
                'institute'         => 'Digital Skills Hub',
                'title'             => 'Video Editing & YouTube Content Creation',
                'short_description' => 'Learn Premiere Pro, DaVinci Resolve, and grow a YouTube channel from scratch.',
                'duration_weeks'    => 10,
                'hours_per_week'    => 8,
                'mode'              => ['Online'],
                'level'             => 'Beginner',
                'price_inr'         => 8000,
                'original_price_inr'=> 12000,
                'certificate'       => true,
                'placement_support' => false,
                'emi_available'     => false,
                'status'            => 'active',
            ],
            [
                'institute'         => 'CodeCraft Institute',
                'title'             => 'Full Stack React & Node.js Bootcamp',
                'short_description' => 'Intensive bootcamp covering React, Node.js, MongoDB, REST APIs and deployment.',
                'duration_weeks'    => 20,
                'hours_per_week'    => 25,
                'mode'              => ['Offline', 'Online'],
                'level'             => 'Intermediate',
                'price_inr'         => 45000,
                'original_price_inr'=> 60000,
                'certificate'       => true,
                'placement_support' => true,
                'emi_available'     => true,
                'status'            => 'active',
            ],
            [
                'institute'         => 'CodeCraft Institute',
                'title'             => 'Machine Learning & AI Fundamentals',
                'short_description' => 'Introduction to ML algorithms, neural networks, and practical AI applications.',
                'duration_weeks'    => 16,
                'hours_per_week'    => 15,
                'mode'              => ['Offline', 'Online'],
                'level'             => 'Advanced',
                'price_inr'         => 38000,
                'original_price_inr'=> 50000,
                'certificate'       => true,
                'placement_support' => true,
                'emi_available'     => true,
                'status'            => 'active',
            ],
            [
                'institute'         => 'Nagpur IT Academy',
                'title'             => 'MS-CIT (Maharashtra State Certificate in IT)',
                'short_description' => 'Government-recognised IT literacy course covering Windows, MS Office, and internet basics.',
                'duration_weeks'    => 12,
                'hours_per_week'    => 6,
                'mode'              => ['Offline'],
                'level'             => 'Beginner',
                'price_inr'         => 4200,
                'original_price_inr'=> null,
                'certificate'       => true,
                'placement_support' => false,
                'emi_available'     => false,
                'status'            => 'active',
            ],
        ];

        foreach ($courses as $courseData) {
            $instituteName = $courseData['institute'];
            unset($courseData['institute']);

            $institute = $institutes->first(fn($i) => str_contains($i->name, explode(' ', $instituteName)[0]));
            if (!$institute) continue;

            Course::create(array_merge($courseData, [
                'institute_id' => $institute->id,
                'slug'         => Str::slug($courseData['title']) . '-' . Str::random(5),
                'language'     => ['Hindi', 'English'],
                'tags'         => [],
                'rating'       => round(4.0 + (mt_rand(0, 10) / 10), 1),
                'review_count' => mt_rand(10, 200),
                'enrolled_count' => mt_rand(50, 500),
            ]));
        }
    }
}
