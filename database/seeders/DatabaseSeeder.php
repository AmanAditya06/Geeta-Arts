<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'phone' => '9876543210',
                'user_type' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'phone' => '9876543211',
            ]
        );

        $this->call(PageContentSeeder::class);

        $this->seedCategoriesAndProducts();
    }

    private function seedCategoriesAndProducts(): void
    {
        $categories = [
            ['name' => 'Paintings', 'description' => 'Traditional and contemporary Indian paintings including Madhubani, Warli, Tanjore, and more.'],
            ['name' => 'Sculptures', 'description' => 'Handcrafted sculptures in brass, marble, wood, and stone depicting deities and artistic forms.'],
            ['name' => 'Pottery', 'description' => 'Beautiful handcrafted pottery including blue pottery, terracotta, and ceramic art pieces.'],
            ['name' => 'Textiles', 'description' => 'Traditional Indian textiles including sarees, dupattas, and handwoven fabrics.'],
            ['name' => 'Jewelry', 'description' => 'Handmade traditional Indian jewelry including silver, Kundan, Meenakari, and tribal designs.'],
            ['name' => 'Home Decor', 'description' => 'Decorative items for your home including diyas, wall hangings, and traditional artifacts.'],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'status' => true,
                ]
            );
        }

        $products = [
            ['name' => 'Madhubani Painting', 'category' => 'Paintings', 'price' => 2499, 'sku' => 'PTG-MDB-001', 'stock' => 10, 'type' => 'painting', 'description' => 'Traditional Madhubani painting done on handmade paper with natural colors, depicting folk art themes.'],
            ['name' => 'Warli Art Canvas', 'category' => 'Paintings', 'price' => 1899, 'sku' => 'PTG-WRL-002', 'stock' => 15, 'type' => 'painting', 'description' => 'Beautiful Warli tribal art painted on canvas showcasing rural life and nature.'],
            ['name' => 'Tanjore Painting', 'category' => 'Paintings', 'price' => 5499, 'sku' => 'PTG-TNJ-003', 'stock' => 5, 'type' => 'painting', 'description' => 'Classic Tanjore painting with gold foil work and semi-precious stones, depicting Lord Krishna.'],
            ['name' => 'Brass Buddha Statue', 'category' => 'Sculptures', 'price' => 3999, 'sku' => 'SCL-BRS-001', 'stock' => 8, 'type' => 'sculpture', 'description' => 'Handcrafted brass Buddha statue in meditating posture, perfect for home decor and spiritual spaces.'],
            ['name' => 'Marble Ganesha', 'category' => 'Sculptures', 'price' => 6999, 'sku' => 'SCL-MRB-002', 'stock' => 4, 'type' => 'sculpture', 'description' => 'Intricately carved white marble Ganesha statue, handcrafted by skilled artisans from Rajasthan.'],
            ['name' => 'Wooden Nataraja', 'category' => 'Sculptures', 'price' => 4599, 'sku' => 'SCL-WDN-003', 'stock' => 6, 'type' => 'sculpture', 'description' => 'Hand-carved wooden Nataraja statue depicting Lord Shiva in cosmic dance pose.'],
            ['name' => 'Blue Pottery Vase', 'category' => 'Pottery', 'price' => 1299, 'sku' => 'POT-BLP-001', 'stock' => 20, 'type' => 'pottery', 'description' => 'Authentic Jaipur blue pottery vase with intricate floral patterns, hand-painted.'],
            ['name' => 'Terracotta Diya Set', 'category' => 'Pottery', 'price' => 499, 'sku' => 'POT-TER-002', 'stock' => 50, 'type' => 'pottery', 'description' => 'Set of 6 handcrafted terracotta diyas, perfect for festivals and home decor.'],
            ['name' => 'Ceramic Coffee Mug Set', 'category' => 'Pottery', 'price' => 899, 'sku' => 'POT-CRM-003', 'stock' => 30, 'type' => 'pottery', 'description' => 'Set of 4 hand-painted ceramic coffee mugs with traditional Indian motifs.'],
            ['name' => 'Banarasi Silk Saree', 'category' => 'Textiles', 'price' => 8999, 'sku' => 'TXT-BNS-001', 'stock' => 7, 'type' => 'textile', 'description' => 'Pure Banarasi silk saree with intricate zari work, a timeless piece of Indian craftsmanship.'],
            ['name' => 'Kalamkari Dupatta', 'category' => 'Textiles', 'price' => 2499, 'sku' => 'TXT-KLM-002', 'stock' => 12, 'type' => 'textile', 'description' => 'Hand-painted Kalamkari cotton dupatta with natural dyes and traditional motifs.'],
            ['name' => 'Cotton Handloom Stole', 'category' => 'Textiles', 'price' => 1499, 'sku' => 'TXT-HND-003', 'stock' => 25, 'type' => 'textile', 'description' => 'Soft handloom cotton stole with traditional woven patterns, lightweight and elegant.'],
            ['name' => 'Silver Jhumka Earrings', 'category' => 'Jewelry', 'price' => 1799, 'sku' => 'JWL-SLV-001', 'stock' => 20, 'type' => 'jewelry', 'description' => 'Traditional silver jhumka earrings with delicate filigree work, lightweight and elegant.'],
            ['name' => 'Kundan Necklace Set', 'category' => 'Jewelry', 'price' => 5999, 'sku' => 'JWL-KDN-002', 'stock' => 5, 'type' => 'jewelry', 'description' => 'Royal Kundan necklace set with earrings, featuring intricate meenakari work and gemstones.'],
            ['name' => 'Tribal Beaded Necklace', 'category' => 'Jewelry', 'price' => 899, 'sku' => 'JWL-TRB-003', 'stock' => 15, 'type' => 'jewelry', 'description' => 'Handcrafted tribal beaded necklace with wooden and metal accents, unique design.'],
            ['name' => 'Brass Diya Set', 'category' => 'Home Decor', 'price' => 699, 'sku' => 'DEC-BRS-001', 'stock' => 40, 'type' => 'decor', 'description' => 'Set of 4 polished brass diyas with intricate engraving, ideal for festivals and daily prayer.'],
            ['name' => 'Wooden Wall Hanging', 'category' => 'Home Decor', 'price' => 1499, 'sku' => 'DEC-WDN-002', 'stock' => 18, 'type' => 'decor', 'description' => 'Hand-carved wooden wall hanging with traditional Indian art design, adds elegance to any room.'],
            ['name' => 'Rangoli Stencil Kit', 'category' => 'Home Decor', 'price' => 349, 'sku' => 'DEC-RNG-003', 'stock' => 35, 'type' => 'decor', 'description' => 'Set of 10 reusable rangoli stencils with various traditional patterns, easy to use.'],
        ];

        $categoryMap = Category::pluck('id', 'name');

        foreach ($products as $data) {
            $categoryId = $categoryMap[$data['category']] ?? null;
            Product::firstOrCreate(
                ['sku' => $data['sku']],
                [
                    'name' => $data['name'],
                    'slug' => \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid(),
                    'category_id' => $categoryId,
                    'type' => $data['type'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'description' => $data['description'],
                    'image' => '',
                    'status' => true,
                    'is_featured' => false,
                ]
            );
        }
    }
}
