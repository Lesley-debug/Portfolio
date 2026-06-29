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
            'live_url'     => 'https://abn-inni.onrender.com',
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
            'stack'        => 'Laravel, MySQL, Multi-tenancy',
            'live_url'     => null,
            'github_url'   => null,
            'is_featured'  => true,
            'sort_order'   => 3,
        ]);
    }
}
