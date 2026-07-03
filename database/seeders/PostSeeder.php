<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Evolution of Hydraulic Systems in Modern Excavators',
                'excerpt' => 'Discover how recent breakthroughs in electro-hydraulic valves and smart control systems are redefining speed, power, and efficiency in excavators.',
                'body' => "Hydraulic systems are the lifeblood of modern excavators. Over the past decade, the industry has transitioned from purely mechanical systems to highly sophisticated electro-hydraulic control systems. This transition has unlocked unprecedented precision, speed, and fuel efficiency on construction sites.\n\n### What is Electro-Hydraulic Control?\n\nTraditional hydraulic valves rely on pilot pressure generated directly by mechanical joystick movement. In contrast, electro-hydraulic systems use electronic joysticks that send digital signals to an Electronic Control Unit (ECU). The ECU then calculates the optimal valve spool position based on multiple parameters, including engine load, system temperature, and operator speed preferences.\n\n### Key Benefits:\n- **Fuel Economy:** By matching hydraulic flow exactly to demand, modern systems reduce parasitic engine drag, saving up to 15% in fuel costs.\n- **Precision Control:** Operators can configure sensitivity profiles, allowing for fine-grading tasks that previously required manual surveying.\n- **Autonomous Integration:** Electronic controls pave the way for semi-autonomous features like boom assist, bucket path control, and digital height limits.\n\nAs heavy machinery continues to align with global environmental mandates, hybrid systems combining hydraulic accumulators and electric drive motors represent the next major horizon.",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'How to Choose the Right Crane for High-Rise Construction',
                'excerpt' => 'A comprehensive guide to selecting between tower cranes, crawler cranes, and mobile cranes for complex vertical construction projects.',
                'body' => "Selecting the right crane for high-rise vertical construction is one of the most critical decisions in project planning. The wrong choice can lead to costly delays, logistical bottlenecks, and safety hazards. Here we break down the three primary crane categories used in modern urban development.\n\n### 1. Tower Cranes\nTower cranes are the gold standard for high-rise buildings. Anchored to the ground or braced inside the structure, they offer incredible height capacity and lifting range. \n*   **Best for:** Buildings exceeding 10 stories where site footprint is tight.\n*   **Advantage:** Zero ground footprint after setup.\n\n### 2. Crawler Cranes\nCrawler cranes utilize tracks instead of wheels, providing excellent stability on soft soil. They do not require stabilizers, allowing them to travel with a load on the hook.\n*   **Best for:** Initial infrastructure setup, heavy structural lifts, and ground prep.\n*   **Advantage:** High load capacity without concrete foundations.\n\n### 3. Mobile Cranes\nFor shorter durations or projects with shifting pick locations, mobile telescopic cranes are unmatched in flexibility. They can drive directly to the site, set up stabilizers, execute the lift, and depart.\n*   **Best for:** Structural steel erection under 10 stories or unloading massive components.\n\n### Key Selection Factors:\nBefore making your selection, verify the **Maximum Lift Weight**, **Radius of Reach**, and **Ground Bearing Capacity**. IronForge provides personalized crane consultations to ensure your project chooses the most optimal rigging solution.",
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Safety Best Practices for Operating Heavy Machinery on Site',
                'excerpt' => 'Explore the fundamental safety protocols that site managers and heavy equipment operators must enforce to achieve zero-accident project sites.',
                'body' => "Heavy machinery is vital for construction progress, but it poses significant safety risks if not handled with absolute care. According to industry statistics, over 70% of machinery-related accidents on job sites are preventable. Implementing strict safety protocols is essential for protecting personnel and assets.\n\n### 1. Pre-Operation Inspections\nEvery operator must perform a visual walkaround inspection before turning the key. Key areas to check include:\n*   Hydraulic fluid levels and signs of leaks.\n*   Tire pressure, track tension, and structural cracks.\n*   Functionality of safety beacons, backup alarms, and seatbelts.\n\n### 2. Maintain Spotter Communication\nBlind spots around massive excavators or wheel loaders are substantial. When working in tight spaces or near active traffic lanes, operators must rely on designated, trained spotters using standard hand signals or two-way radios.\n\n### 3. Safe Zone Clearance\nEstablish clear physical boundaries separating foot traffic from heavy equipment work zones. Use high-visibility fencing and signage. Pedestrians must always make eye contact and receive clearance before entering an operator's active working zone.\n\nAt IronForge, we build advanced safety features directly into our machinery, including 360-degree radar sensors and automatic engine cutoff systems, because worker safety is our ultimate priority.",
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'IronForge Unveils New Eco-Friendly Wheel Loader Series',
                'excerpt' => 'Introducing the Apex eco-series wheel loaders: lower emissions, hybrid drivetrains, and smart cabin comfort designed for future-ready job sites.',
                'body' => "IronForge Machinery is proud to officially announce the launch of our next-generation **Apex Eco-Series Wheel Loaders**. Engineered to meet stringent global Tier-4 emissions standards without sacrificing breakout force, the new series represents a monumental leap forward in green industrial engineering.\n\n### Smart Hybrid Drivetrains\nAt the core of the Apex Eco-Series is a proprietary diesel-electric hybrid system. Regenerative braking captures kinetic energy as the loader decelerates or lowers its bucket, storing it in heavy-duty capacitors. This power is then redirected to assist the primary engine during high-load digging cycles, reducing diesel consumption by up to 22%.\n\n### Elevated Operator Comfort\nA redesigned cabin features active vibration dampening, an ergonomic seating arrangement, and a multi-display touch console. Noise levels inside the cabin have been reduced to a whisper-quiet 68 dB, reducing operator fatigue and increasing productivity.\n\n### Connectivity & Telematics\nEvery Apex Eco-Series loader comes pre-equipped with **IronForge Telematics Link**, allowing fleet managers to track real-time fuel efficiency, component health, and exhaust emission data from their mobile devices.\n\nContact our sales team today to schedule a live demonstration at our training facilities.",
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $item) {
            Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'body' => $item['body'],
                'image' => null, // seeded posts will use placeholders or custom illustrations
                'is_published' => $item['is_published'],
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
