<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Seed the page_contents table with placeholder data for every
     * section_key referenced across the site's blade views.
     */
    public function run(): void
    {
        $rows = [
            // ===== HOME PAGE =====
            [
                'page_slug' => 'home',
                'section_key' => 'home_intro_left',
                'title' => 'Crafted with Passion',
                'description' => 'Every piece of furniture we create blends traditional craftsmanship with modern design, built to last for generations.',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_intro_left_2',
                'title' => 'Sustainable Materials',
                'description' => 'We source responsibly, using sustainably harvested wood and eco-friendly finishes in every product we make.',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_intro_right',
                'title' => 'Timeless Design',
                'description' => 'Our designs are made to complement any home, combining elegance with everyday functionality.',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_intro_right_2',
                'title' => 'Built to Order',
                'description' => 'Each item is carefully handmade to order, ensuring quality and attention to detail in every corner.',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_intro_image',
                'image' => 'i.jpg',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_collections',
                'title' => 'Our Collections',
                'subtitle' => 'Explore furniture designed for every room in your home',
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'home_premium',
                'title' => 'Premium Quality',
                'subtitle' => 'Furniture that stands the test of time',
            ],

            // ===== ABOUT PAGE =====
            [
                'page_slug' => 'about',
                'section_key' => 'about_story',
                'label' => 'Our Story',
                'title' => 'A Legacy of Craftsmanship',
                'description' => 'Founded with a passion for fine woodworking, our studio has spent years perfecting the art of handmade furniture, blending heritage techniques with contemporary style.',
                'image' => 'i.jpg',
            ],
            [
                'page_slug' => 'about',
                'section_key' => 'team_heading',
                'title' => 'Meet Our Team',
                'subtitle' => 'The people behind every piece we create',
            ],
            [
                'page_slug' => 'about',
                'section_key' => 'member1',
                'label' => 'Founder & Lead Designer',
                'subtitle' => 'Ravi Sharma',
                'image' => 'm.jpg',
            ],
            [
                'page_slug' => 'about',
                'section_key' => 'member2',
                'label' => 'Master Craftsman',
                'subtitle' => 'Anjali Verma',
                'image' => 'w.jpg',
            ],
            [
                'page_slug' => 'about',
                'section_key' => 'member3',
                'label' => 'Workshop Manager',
                'subtitle' => 'Sanjay Patel',
                'image' => 'b.jpg',
            ],

            // ===== CONTACT PAGE =====
            [
                'page_slug' => 'contact',
                'section_key' => 'contact_main',
                'label' => 'Get In Touch',
                'title' => 'Contact Us',
                'subtitle' => 'We would love to hear from you',
            ],
            [
                'page_slug' => 'contact',
                'section_key' => 'contact_address',
                'title' => 'Our Address',
                'description' => '123 Workshop Lane, Bengaluru, Karnataka, India',
            ],
            [
                'page_slug' => 'contact',
                'section_key' => 'contact_phone',
                'title' => 'Phone',
                'description' => '+91 98765 43210',
            ],
            [
                'page_slug' => 'contact',
                'section_key' => 'contact_email',
                'title' => 'Email',
                'description' => 'support@geetaart.com',
            ],
            [
                'page_slug' => 'contact',
                'section_key' => 'contact_working',
                'label' => 'Working Hours',
                'title' => 'When We Are Open',
                'description' => 'Monday - Saturday: 9:00 AM - 7:00 PM',
            ],

            // ===== CUSTOMISATION PAGE =====
            [
                'page_slug' => 'customisation',
                'section_key' => 'cust_main',
                'label' => 'Made For You',
                'title' => 'Customise Your Furniture',
                'description' => 'Choose your own materials, finishes, and dimensions. Our team works with you to create a piece that fits your space perfectly.',
                'image' => 'i.jpg',
            ],

            // ===== CUSTOMER SERVICE PAGE =====
            [
                'page_slug' => 'customer-service',
                'section_key' => 'shipping_policy',
                'label' => 'Shipping',
                'title' => 'Shipping Policy',
                'description' => 'We ship across India with careful packaging to ensure your furniture arrives in perfect condition.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'shipping_rates',
                'title' => 'Shipping Rates',
                'description' => 'Shipping rates vary by location and order size. Free shipping is available on orders above a set threshold.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'order_tracking',
                'title' => 'Order Tracking',
                'description' => 'Once your order ships, you will receive a tracking link via email to monitor delivery progress.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'return_policy',
                'label' => 'Returns',
                'title' => 'Return Policy',
                'description' => 'Items can be returned within 14 days of delivery if they are unused and in original packaging.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'return_steps',
                'title' => 'How To Return An Item',
                'description' => 'Contact our support team with your order number, and we will arrange a pickup and process your refund.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'refund_process',
                'title' => 'Refund Process',
                'description' => 'Refunds are processed within 5-7 business days after the returned item passes inspection.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'terms_general',
                'label' => 'Terms',
                'title' => 'General Terms',
                'description' => 'By using our website and placing an order, you agree to our terms of service outlined here.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'terms_products',
                'title' => 'Product Information',
                'description' => 'We strive to display product colors and details as accurately as possible, though slight variations may occur.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'terms_pricing',
                'title' => 'Pricing',
                'description' => 'All prices are listed in INR and are subject to change without prior notice.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'terms_liability',
                'title' => 'Limitation of Liability',
                'description' => 'We are not liable for indirect or consequential damages arising from the use of our products.',
            ],
            [
                'page_slug' => 'customer-service',
                'section_key' => 'terms_law',
                'title' => 'Governing Law',
                'description' => 'These terms are governed by the laws of India.',
            ],
        ];

        foreach ($rows as $row) {
            PageContent::updateOrCreate(
                [
                    'page_slug' => $row['page_slug'],
                    'section_key' => $row['section_key'],
                ],
                array_merge([
                    'label' => null,
                    'title' => null,
                    'subtitle' => null,
                    'description' => null,
                    'image' => null,
                    'status' => 1,
                ], $row)
            );
        }
    }
}
