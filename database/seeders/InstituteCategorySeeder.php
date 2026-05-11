<?php

namespace Database\Seeders;

use App\Models\InstituteCategory;
use Illuminate\Database\Seeder;

class InstituteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Computer Institute',
                'slug'        => 'computer-institute',
                'description' => 'Institutes offering computer courses, programming, software development, and IT training.',
                'icon'        => 'computer',
                'color'       => '#3B82F6',
                'text_color'  => '#ffffff',
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Coaching Centre',
                'slug'        => 'coaching-centre',
                'description' => 'Academic coaching for competitive exams, board exams, and entrance tests.',
                'icon'        => 'coaching',
                'color'       => '#8B5CF6',
                'text_color'  => '#ffffff',
                'sort_order'  => 2,
            ],
            [
                'name'        => 'School',
                'slug'        => 'school',
                'description' => 'Primary, secondary, and senior secondary schools for holistic education.',
                'icon'        => 'school',
                'color'       => '#10B981',
                'text_color'  => '#ffffff',
                'sort_order'  => 3,
            ],
            [
                'name'        => 'College',
                'slug'        => 'college',
                'description' => 'Degree, diploma, and post-graduate colleges across streams.',
                'icon'        => 'college',
                'color'       => '#F59E0B',
                'text_color'  => '#ffffff',
                'sort_order'  => 4,
            ],
            [
                'name'        => 'Skill Development',
                'slug'        => 'skill-development',
                'description' => 'Vocational training and skill development programs for employment.',
                'icon'        => 'skill',
                'color'       => '#EF4444',
                'text_color'  => '#ffffff',
                'sort_order'  => 5,
            ],
            [
                'name'        => 'Language Institute',
                'slug'        => 'language-institute',
                'description' => 'Foreign language, spoken English, and communication skill training.',
                'icon'        => 'language',
                'color'       => '#06B6D4',
                'text_color'  => '#ffffff',
                'sort_order'  => 6,
            ],
            [
                'name'        => 'Design & Arts',
                'slug'        => 'design-arts',
                'description' => 'Graphic design, fine arts, animation, fashion design, and creative arts.',
                'icon'        => 'design',
                'color'       => '#EC4899',
                'text_color'  => '#ffffff',
                'sort_order'  => 7,
            ],
            [
                'name'        => 'Healthcare & Paramedical',
                'slug'        => 'healthcare-paramedical',
                'description' => 'Nursing, pharmacy, medical lab, and paramedical courses.',
                'icon'        => 'healthcare',
                'color'       => '#14B8A6',
                'text_color'  => '#ffffff',
                'sort_order'  => 8,
            ],
            [
                'name'        => 'Fitness & Sports',
                'slug'        => 'fitness-sports',
                'description' => 'Gym, yoga, martial arts, sports academies, and fitness training.',
                'icon'        => 'fitness',
                'color'       => '#F97316',
                'text_color'  => '#ffffff',
                'sort_order'  => 9,
            ],
            [
                'name'        => 'Finance & Commerce',
                'slug'        => 'finance-commerce',
                'description' => 'Accounting, CA, finance, banking, and commerce-related training.',
                'icon'        => 'finance',
                'color'       => '#6366F1',
                'text_color'  => '#ffffff',
                'sort_order'  => 10,
            ],
        ];

        foreach ($categories as $cat) {
            InstituteCategory::updateOrCreate(['slug' => $cat['slug']], array_merge($cat, ['is_active' => true]));
        }
    }
}
