<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Institute;
use App\Models\InstituteCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        $computerCat = InstituteCategory::where('slug', 'computer-institute')->first();
        $coachingCat = InstituteCategory::where('slug', 'coaching-centre')->first();
        $skillCat    = InstituteCategory::where('slug', 'skill-development')->first();

        $mumbai    = City::where('name', 'Mumbai')->first();
        $pune      = City::where('name', 'Pune')->first();
        $delhi     = City::where('name', 'Delhi')->first();
        $bangalore = City::where('name', 'Bangalore')->first();
        $thane     = City::where('name', 'Thane')->first();
        $nagpur    = City::where('name', 'Nagpur')->first();

        if (!$computerCat || !$mumbai) return;

        $institutes = [
            [
                'name'             => 'Genius Computer Institute',
                'slug'             => 'genius-computer-institute-virar-' . Str::random(4),
                'tagline'          => 'Shaping Digital Futures Since 2005',
                'about'            => 'Genius Computer Institute is one of the most trusted computer training centers in Virar. With over 18 years of experience, we have trained more than 5000 students in various IT courses.',
                'city_id'          => $thane ? $thane->id : $mumbai->id,
                'category_id'      => $computerCat->id,
                'area'             => 'Virar West',
                'pincode'          => '401303',
                'full_address'     => 'Shop No. 12, Sai Complex, Station Road, Virar West, Thane',
                'phone'            => '+91-9876543210',
                'whatsapp'         => '+91-9876543210',
                'email'            => 'info@geniuscomputer.in',
                'website'          => 'https://geniuscomputer.in',
                'rating'           => 4.7,
                'review_count'     => 128,
                'students_trained' => 5000,
                'years_active'     => 18,
                'certifications'   => ['ISO 9001:2015', 'NSDC Certified', 'Microsoft Partner'],
                'facilities'       => ['AC Classroom', 'Free WiFi', 'Library', 'Placement Cell', 'Online Classes'],
                'socials'          => ['facebook' => 'https://facebook.com/geniuscomputer', 'instagram' => 'https://instagram.com/geniuscomputer'],
                'status'           => 'active',
                'is_verified'      => true,
                'is_featured'      => true,
            ],
            [
                'name'             => 'TechPro Academy',
                'slug'             => 'techpro-academy-borivali-' . Str::random(4),
                'tagline'          => 'Learn. Code. Succeed.',
                'about'            => 'TechPro Academy offers industry-relevant IT and programming courses with a focus on practical skills and job placement assistance.',
                'city_id'          => $mumbai->id,
                'category_id'      => $computerCat->id,
                'area'             => 'Borivali West',
                'pincode'          => '400092',
                'full_address'     => '2nd Floor, Chandrika Complex, Borivali West, Mumbai',
                'phone'            => '+91-9123456789',
                'whatsapp'         => '+91-9123456789',
                'email'            => 'contact@techproacademy.in',
                'website'          => 'https://techproacademy.in',
                'rating'           => 4.5,
                'review_count'     => 89,
                'students_trained' => 3200,
                'years_active'     => 12,
                'certifications'   => ['NSDC Certified', 'AWS Training Partner'],
                'facilities'       => ['AC Classroom', 'Lab with 30 PCs', 'Placement Support', 'Weekend Batches'],
                'socials'          => ['linkedin' => 'https://linkedin.com/company/techproacademy'],
                'status'           => 'active',
                'is_verified'      => true,
                'is_featured'      => false,
            ],
            [
                'name'             => 'BrightMind Coaching Centre',
                'slug'             => 'brightmind-coaching-pune-' . Str::random(4),
                'tagline'          => 'Ignite Your Potential',
                'about'            => 'BrightMind provides top-quality coaching for JEE, NEET, and board examinations with experienced faculty and comprehensive study material.',
                'city_id'          => $pune ? $pune->id : $mumbai->id,
                'category_id'      => $coachingCat ? $coachingCat->id : $computerCat->id,
                'area'             => 'Kothrud',
                'pincode'          => '411038',
                'full_address'     => 'Plot 45, Anand Park, Kothrud, Pune',
                'phone'            => '+91-9988776655',
                'whatsapp'         => '+91-9988776655',
                'email'            => 'info@brightmind.co.in',
                'website'          => null,
                'rating'           => 4.6,
                'review_count'     => 214,
                'students_trained' => 8000,
                'years_active'     => 15,
                'certifications'   => ['ISO 9001:2015'],
                'facilities'       => ['Smart Classroom', 'Doubt Sessions', 'Mock Tests', 'Library', 'Hostel Facility'],
                'socials'          => [],
                'status'           => 'active',
                'is_verified'      => true,
                'is_featured'      => true,
            ],
            [
                'name'             => 'Digital Skills Hub',
                'slug'             => 'digital-skills-hub-delhi-' . Str::random(4),
                'tagline'          => 'Future-Ready Skills for Everyone',
                'about'            => 'Digital Skills Hub is a premier skill development center offering courses in digital marketing, web design, video editing, and more.',
                'city_id'          => $delhi ? $delhi->id : $mumbai->id,
                'category_id'      => $skillCat ? $skillCat->id : $computerCat->id,
                'area'             => 'Lajpat Nagar',
                'pincode'          => '110024',
                'full_address'     => 'C-12, Central Market, Lajpat Nagar II, New Delhi',
                'phone'            => '+91-9811223344',
                'whatsapp'         => '+91-9811223344',
                'email'            => 'hello@digitalskillshub.in',
                'website'          => 'https://digitalskillshub.in',
                'rating'           => 4.3,
                'review_count'     => 67,
                'students_trained' => 1800,
                'years_active'     => 6,
                'certifications'   => ['Google Partner', 'Meta Blueprint Partner'],
                'facilities'       => ['Free WiFi', 'Practical Labs', 'Internship Assistance', 'Online + Offline'],
                'socials'          => ['instagram' => 'https://instagram.com/digitalskillshub', 'youtube' => 'https://youtube.com/digitalskillshub'],
                'status'           => 'active',
                'is_verified'      => false,
                'is_featured'      => false,
            ],
            [
                'name'             => 'CodeCraft Institute',
                'slug'             => 'codecraft-institute-bangalore-' . Str::random(4),
                'tagline'          => 'Where Coders Are Born',
                'about'            => 'CodeCraft specializes in full-stack development, data science, and machine learning bootcamps designed for working professionals and freshers.',
                'city_id'          => $bangalore ? $bangalore->id : $mumbai->id,
                'category_id'      => $computerCat->id,
                'area'             => 'Koramangala',
                'pincode'          => '560034',
                'full_address'     => '80 Feet Road, Block 3, Koramangala, Bangalore',
                'phone'            => '+91-9900112233',
                'whatsapp'         => '+91-9900112233',
                'email'            => 'admissions@codecraft.in',
                'website'          => 'https://codecraft.in',
                'rating'           => 4.8,
                'review_count'     => 342,
                'students_trained' => 6500,
                'years_active'     => 9,
                'certifications'   => ['AWS Training Partner', 'Google Cloud Partner', 'NASSCOM Member'],
                'facilities'       => ['High-End Workstations', 'Mentorship Program', '100% Placement Assistance', 'Industry Projects'],
                'socials'          => ['linkedin' => 'https://linkedin.com/company/codecraft', 'youtube' => 'https://youtube.com/codecraft'],
                'status'           => 'active',
                'is_verified'      => true,
                'is_featured'      => true,
            ],
            [
                'name'             => 'Nagpur IT Academy',
                'slug'             => 'nagpur-it-academy-' . Str::random(4),
                'tagline'          => 'Building IT Careers in Central India',
                'about'            => 'Nagpur IT Academy provides affordable computer education with government-recognized certifications for students across Central India.',
                'city_id'          => $nagpur ? $nagpur->id : $mumbai->id,
                'category_id'      => $computerCat->id,
                'area'             => 'Sitabuldi',
                'pincode'          => '440012',
                'full_address'     => 'Near Central Mall, Sitabuldi, Nagpur',
                'phone'            => '+91-7122334455',
                'whatsapp'         => '+91-7122334455',
                'email'            => 'nagpurit@gmail.com',
                'website'          => null,
                'rating'           => 4.1,
                'review_count'     => 53,
                'students_trained' => 2100,
                'years_active'     => 11,
                'certifications'   => ['MSCIT Authorized Centre', 'Tally Authorized Partner'],
                'facilities'       => ['AC Classroom', '20 Computers', 'Evening Batches'],
                'socials'          => [],
                'status'           => 'pending',
                'is_verified'      => false,
                'is_featured'      => false,
            ],
        ];

        foreach ($institutes as $data) {
            Institute::create($data);
        }
    }
}
