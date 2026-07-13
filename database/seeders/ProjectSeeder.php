<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title'        => 'ABN Building Project',
            'slug'         => 'abn-building-project',
            'summary'      => 'A construction and real estate company website with blog, project gallery, and admin CMS.',
            'description'  => "ABN is a full-stack PHP application built for a construction and real estate company in Cameroon. It features a custom admin dashboard for managing blog posts and project listings, a public-facing gallery showcasing completed projects, and a contact system. The project was deployed using Render with a remote MySQL database, overcoming real-world hosting and deployment challenges along the way.",
            'stack'        => 'Procedural PHP, MySQL, Docker, Render',
            'cover_image'  => 'abn.png',
            'live_url'     => 'https://abnbuild-new.ct.ws/',
            'github_url'   => null,
            'is_featured'  => true,
            'sort_order'   => 1,
        ]);

        Project::create([
            'title'        => 'NST Herbal Clinic',
            'slug'         => 'nst-herbal-clinic',
            'summary'      => 'A Laravel-powered e-commerce and clinic management platform with coupons, consultations, and automated email flows.',
            'description'  => "NST Herbal Clinic is a full-stack Laravel application for a herbal wellness clinic in Bamenda, Cameroon. It includes a complete e-commerce shop with cart and checkout, a coupon system with usage tracking, consultation booking, contact forms, newsletter subscriptions, and automated transactional emails (welcome emails, order confirmations, admin notifications). The admin dashboard gives the clinic full visibility into orders, consultations, and subscribers.",
            'stack'        => 'Laravel, MySQL, Jetstream, Blade, JavaScript',
            'cover_image'  => 'nst.png',
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => true,
            'sort_order'   => 2,
        ]);

        Project::create([
            'title'        => 'Invento Track',
            'slug'         => 'invento-track',
            'summary'      => 'A multi-tenant inventory and sales management system built with Laravel.',
            'description'  => "Invento Track is a multi-tenant SaaS-style inventory management system covering products, stock levels, suppliers, purchase orders, sales orders, invoices, and payments. It uses a tenant-based architecture so multiple businesses can use the same platform with isolated data, along with role-based access for admins, managers, and staff.",
            'stack'        => 'Laravel, MySQL, Multi-tenancy, Laravel livewire',
            'cover_image'  => 'invento.png',
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => true,
            'sort_order'   => 3,
        ]);

        Project::create([
            'title'        => 'Reading Space',
            'slug'         => 'reading-space',
            'summary'      => 'A community reading and book-tracking platform where users log books, write reviews, and join reading challenges.',
            'description'  => "Reading Space is a social reading platform currently in development. It allows users to track their reading progress, write and share book reviews, create reading lists, and join community reading challenges. Built with Laravel and React for a reactive experience without a heavy JS framework.",
            'stack'        => 'Laravel, React, MySQL, Blade',
            'cover_image'  => null,
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => false,
            'sort_order'   => 4,
        ]);

        Project::create([
            'title'        => 'RicheCoursos',
            'slug'         => 'riche-coursos',
            'summary'      => 'An online learning platform with course management, video lessons, quizzes, and student progress tracking.',
            'description'  => "RicheCoursos is an e-learning platform in active development. Instructors can create and publish courses with video lessons, quizzes, and downloadable resources. Students get a dashboard to track progress, earn certificates, and manage enrollments. Payments are handled via a local payment gateway integration.",
            'stack'        => 'Laravel, MySQL, Livewire, JavaScript',
            'cover_image'  => null,
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => false,
            'sort_order'   => 5,
        ]);

        Project::create([
            'title'        => 'Pruc',
            'slug'         => 'pruc',
            'summary'      => 'A project and task management tool built for small teams, with boards, assignments, and deadline tracking.',
            'description'  => "Pruc is a lightweight project management tool designed for small development teams. It features kanban-style boards, task assignments, priority levels, deadline tracking, and team notifications. Currently in development with a focus on simplicity over feature bloat.",
            'stack'        => 'Laravel, Livewire, MySQL, Alpine.js',
            'cover_image'  => null,
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => false,
            'sort_order'   => 6,
        ]);
    }
}
