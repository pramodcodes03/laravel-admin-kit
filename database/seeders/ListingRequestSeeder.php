<?php

namespace Database\Seeders;

use App\Models\ListingRequest;
use Illuminate\Database\Seeder;

class ListingRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            [
                'institute_name' => 'Sunrise Computer Education',
                'owner_name'     => 'Ramesh Sharma',
                'mobile'         => '9876001122',
                'email'          => 'ramesh@sunrise.in',
                'city'           => 'Nashik',
                'pincode'        => '422001',
                'category'       => 'Computer Institute',
                'message'        => 'We have been running this institute for 8 years and want to list on your platform to reach more students.',
                'status'         => 'pending',
                'admin_notes'    => null,
            ],
            [
                'institute_name' => 'Excel Coaching Academy',
                'owner_name'     => 'Priya Patel',
                'mobile'         => '9988112233',
                'email'          => 'priya.patel@excel.co.in',
                'city'           => 'Surat',
                'pincode'        => '395003',
                'category'       => 'Coaching Centre',
                'message'        => 'We offer JEE and NEET coaching with excellent results. Interested in listing.',
                'status'         => 'approved',
                'admin_notes'    => 'Verified via phone call. Credentials look genuine. Proceed with listing.',
            ],
            [
                'institute_name' => 'InnoTech Skills Center',
                'owner_name'     => 'Ajay Kumar',
                'mobile'         => '9911223344',
                'email'          => null,
                'city'           => 'Lucknow',
                'pincode'        => '226001',
                'category'       => 'Skill Development',
                'message'        => 'We conduct vocational training courses funded by state government.',
                'status'         => 'pending',
                'admin_notes'    => null,
            ],
            [
                'institute_name' => 'Quick Learn Institute',
                'owner_name'     => 'Sneha Joshi',
                'mobile'         => '8800991122',
                'email'          => 'sneha@quicklearn.in',
                'city'           => 'Indore',
                'pincode'        => '452001',
                'category'       => 'Computer Institute',
                'message'        => null,
                'status'         => 'rejected',
                'admin_notes'    => 'Phone number not reachable after 3 attempts. Listing rejected.',
            ],
            [
                'institute_name' => 'Gyan Sagar Academy',
                'owner_name'     => 'Mohan Das',
                'mobile'         => '7700881199',
                'email'          => 'gyansagar@gmail.com',
                'city'           => 'Bhopal',
                'pincode'        => '462001',
                'category'       => 'Coaching Centre',
                'message'        => 'We provide affordable coaching for Class 9-12 students in Bhopal.',
                'status'         => 'pending',
                'admin_notes'    => null,
            ],
        ];

        foreach ($requests as $data) {
            ListingRequest::create($data);
        }
    }
}
