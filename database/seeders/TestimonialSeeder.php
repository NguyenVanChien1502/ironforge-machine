<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Marcus Vance',
                'company' => 'Apex Infrastructure Group',
                'rating' => 5,
                'content' => 'The Prime XL 950 has been operating on our site for 6 months straight without a single hour of unplanned downtime. Outstanding build quality and responsive customer service.',
            ],
            [
                'customer_name' => 'Elena Rostova',
                'company' => 'Siberia Mining Corp',
                'rating' => 5,
                'content' => "IronForge's heavy-duty cranes completely changed the game for our site preparation. Their technical support engineers came directly to our remote site to ensure proper operator safety training.",
            ],
            [
                'customer_name' => 'David Chen',
                'company' => 'Metro Roadworks Ltd',
                'rating' => 4,
                'content' => 'Excellent fuel efficiency on the WL 340 wheel loaders. It has saved us thousands in diesel costs over a short project lifecycle. Highly recommended for heavy commercial infrastructure.',
            ],
            [
                'customer_name' => 'Sarah Jenkins',
                'company' => 'Jenkins Demolition Ltd',
                'rating' => 5,
                'content' => "We have purchased earthmovers from three different global brands, but IronForge's BD 780 out-lifts and out-pushes them all. Their custom engineering solutions team was incredibly helpful during purchasing.",
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::create([
                'customer_name' => $item['customer_name'],
                'company' => $item['company'],
                'avatar' => null, // seeded testimonials will use UI-Avatars automatically
                'rating' => $item['rating'],
                'content' => $item['content'],
                'is_visible' => true,
            ]);
        }
    }
}
