<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::first();
        if (!$admin) return;

        $posts = [
            [
                'title'        => 'Top 10 Computer Courses That Guarantee Jobs in 2025',
                'excerpt'      => 'Looking for a career in IT? These 10 computer courses have the highest placement rates and salary packages in India today.',
                'content'      => "The IT industry in India continues to grow at an unprecedented pace. Whether you're a fresh graduate or looking to switch careers, the right computer course can transform your future.\n\n## 1. Full Stack Web Development\nFull stack development remains the most in-demand skill. Companies need professionals who can handle both frontend and backend development.\n\n## 2. Data Science & Machine Learning\nWith the AI boom, data scientists are among the highest-paid professionals in India.\n\n## 3. Cloud Computing (AWS/Azure/GCP)\nCloud skills are essential for modern IT infrastructure management.\n\n## 4. Cybersecurity\nAs cyber threats increase, security professionals are in high demand.\n\n## 5. Mobile App Development\nFlutter and React Native developers are sought after across India.\n\nStart your journey with any of these courses and transform your career in 2025!",
                'read_time'    => 5,
                'tags'         => ['career', 'computer courses', 'IT jobs', 'placement'],
                'is_featured'  => true,
                'status'       => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title'        => 'How to Choose the Right Institute for Your Child',
                'excerpt'      => 'Choosing the right educational institute is one of the most important decisions parents make. Here is a complete guide.',
                'content'      => "Finding the right educational institute for your child requires careful consideration of multiple factors.\n\n## Faculty Quality\nThe teachers are the backbone of any good institute. Look for experienced faculty with practical knowledge.\n\n## Infrastructure\nGood infrastructure including smart classrooms, labs, and libraries enhances learning.\n\n## Placement Record\nFor professional courses, always check the placement records and alumni success stories.\n\n## Fees vs Value\nDon't always go for the cheapest option. Look for value — what you get for the fees paid.\n\n## Student Reviews\nRead genuine reviews on platforms like Google and trusted directories before making a decision.\n\nUse NearEducationalHub to compare institutes in your city and make an informed choice!",
                'read_time'    => 4,
                'tags'         => ['parenting', 'education', 'guide', 'institute selection'],
                'is_featured'  => false,
                'status'       => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Free vs Paid Online Courses: Which Is Better?',
                'excerpt'      => 'With thousands of online learning platforms available, should you pay for courses or stick to free options?',
                'content'      => "The rise of online learning has democratized education, but it also created confusion about whether free courses are worth it.\n\n## Free Courses: Pros and Cons\n**Pros:** No financial risk, accessible to everyone, great for exploration.\n**Cons:** No certificate, no structured support, easy to quit.\n\n## Paid Courses: Pros and Cons\n**Pros:** Structured curriculum, mentor support, recognized certificates, placement assistance.\n**Cons:** Cost, need to choose wisely to avoid scams.\n\n## Our Recommendation\nFor basic exploration, free courses are fine. For career change or serious skill building, invest in a reputed paid course from a recognized institute.\n\nNearEducationalHub helps you find verified institutes in your city with transparent pricing and reviews.",
                'read_time'    => 3,
                'tags'         => ['online learning', 'courses', 'career tips'],
                'is_featured'  => false,
                'status'       => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($posts as $postData) {
            BlogPost::create(array_merge($postData, [
                'admin_id' => $admin->id,
                'slug'     => Str::slug($postData['title']) . '-' . Str::random(5),
            ]));
        }
    }
}
