<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Institute;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        $institutes = Institute::all();
        $courses    = Course::all();

        if ($institutes->isEmpty()) return;

        $inquiries = [
            [
                'name'    => 'Ravi Mehta',
                'email'   => 'ravi.mehta@gmail.com',
                'phone'   => '9876543001',
                'city'    => 'Mumbai',
                'message' => 'I am interested in the full stack web development course. Please share the batch schedule.',
                'source'  => 'form',
                'status'  => 'new',
            ],
            [
                'name'    => 'Anjali Singh',
                'email'   => 'anjali.singh@yahoo.com',
                'phone'   => '9876543002',
                'city'    => 'Pune',
                'message' => 'Looking for computer courses for my daughter. She has just passed 12th std.',
                'source'  => 'form',
                'status'  => 'contacted',
                'admin_notes' => 'Called on 10 May. Interested in DTP + Tally combo. Follow up next week.',
                'contacted_at' => now()->subDays(2),
            ],
            [
                'name'    => 'Suresh Nair',
                'email'   => null,
                'phone'   => '9876543003',
                'city'    => 'Bangalore',
                'message' => 'What is the fee for ML course?',
                'source'  => 'whatsapp',
                'status'  => 'converted',
                'admin_notes' => 'Enrolled in ML Fundamentals batch starting June 1.',
                'contacted_at' => now()->subDays(5),
            ],
            [
                'name'    => 'Pooja Sharma',
                'email'   => 'pooja.s@gmail.com',
                'phone'   => '9876543004',
                'city'    => 'Delhi',
                'message' => 'Please provide details about digital marketing course duration and fees.',
                'source'  => 'form',
                'status'  => 'new',
            ],
            [
                'name'    => 'Kiran Patil',
                'email'   => 'kiran.patil@outlook.com',
                'phone'   => '9876543005',
                'city'    => 'Nagpur',
                'message' => null,
                'source'  => 'phone',
                'status'  => 'closed',
                'admin_notes' => 'Was looking for offline Python course. Not available in their city.',
            ],
            [
                'name'    => 'Vikram Gupta',
                'email'   => 'vikram.gupta@gmail.com',
                'phone'   => '9876543006',
                'city'    => 'Mumbai',
                'message' => 'I want to enroll my son in Tally course. Is Saturday batch available?',
                'source'  => 'form',
                'status'  => 'new',
            ],
            [
                'name'    => 'Meena Rao',
                'email'   => null,
                'phone'   => '9876543007',
                'city'    => 'Hyderabad',
                'message' => 'Inquiry about JEE coaching batches for 2025-26.',
                'source'  => 'whatsapp',
                'status'  => 'contacted',
                'contacted_at' => now()->subDays(1),
            ],
            [
                'name'    => 'Arun Kumar',
                'email'   => 'arun.k@gmail.com',
                'phone'   => '9876543008',
                'city'    => 'Chennai',
                'message' => 'Looking for graphic design course with placement assistance.',
                'source'  => 'form',
                'status'  => 'new',
            ],
            [
                'name'    => 'Sunita Devi',
                'email'   => 'sunita.d@yahoo.in',
                'phone'   => '9876543009',
                'city'    => 'Jaipur',
                'message' => 'I am a homemaker and want to learn basic computer skills. Which course is best for me?',
                'source'  => 'form',
                'status'  => 'converted',
                'admin_notes' => 'Enrolled in basic computer literacy course.',
                'contacted_at' => now()->subDays(8),
            ],
            [
                'name'    => 'Deepak Verma',
                'email'   => 'deepak.v@gmail.com',
                'phone'   => '9876543010',
                'city'    => 'Lucknow',
                'message' => 'What is the eligibility for the data science course?',
                'source'  => 'form',
                'status'  => 'new',
            ],
        ];

        foreach ($inquiries as $i => $data) {
            $institute = $institutes->get($i % $institutes->count());
            $course    = $courses->count() > 0 ? $courses->get($i % $courses->count()) : null;

            Inquiry::create(array_merge($data, [
                'institute_id' => $institute->id,
                'course_id'    => $course?->id,
            ]));
        }
    }
}
