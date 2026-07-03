<?php

namespace Tests\Feature\Api\V1;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_filtered_and_viewed_by_slug(): void
    {
        $category = Category::factory()->create([
            'name' => 'Excavators',
            'slug' => 'excavators',
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'title' => 'IronForge EX-200',
            'slug' => 'ironforge-ex-200',
            'is_featured' => true,
        ]);
        $otherCategory = Category::factory()->create([
            'name' => 'Cranes',
            'slug' => 'cranes',
        ]);
        Product::factory()->create([
            'category_id' => $otherCategory->id,
            'is_featured' => false,
        ]);

        $this->getJson('/api/v1/products?category=excavators&featured=1')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $product->id)
            ->assertJsonPath('data.0.category.slug', 'excavators');

        $this->getJson('/api/v1/products/ironforge-ex-200')
            ->assertOk()
            ->assertJsonPath('data.slug', 'ironforge-ex-200');
    }

    public function test_only_published_posts_and_visible_testimonials_are_public(): void
    {
        Post::query()->create([
            'title' => 'Published post',
            'slug' => 'published-post',
            'body' => 'Content',
            'is_published' => true,
            'published_at' => now(),
        ]);
        Post::query()->create([
            'title' => 'Draft post',
            'slug' => 'draft-post',
            'body' => 'Draft',
            'is_published' => false,
        ]);
        Testimonial::query()->create([
            'customer_name' => 'Visible customer',
            'rating' => 5,
            'content' => 'Great service',
            'is_visible' => true,
        ]);
        Testimonial::query()->create([
            'customer_name' => 'Hidden customer',
            'rating' => 5,
            'content' => 'Hidden',
            'is_visible' => false,
        ]);

        $this->getJson('/api/v1/posts')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.slug', 'published-post');

        $this->getJson('/api/v1/posts/draft-post')->assertNotFound();

        $this->getJson('/api/v1/testimonials')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.customer_name', 'Visible customer');
    }

    public function test_inquiry_validation_and_creation(): void
    {
        $this->postJson('/api/v1/inquiries', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'phone', 'email']);

        $this->postJson('/api/v1/inquiries', [
            'name' => 'Nguyễn Văn An',
            'phone' => '0901234567',
            'email' => 'an@example.com',
            'message' => 'Tôi cần báo giá.',
        ])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Nguyễn Văn An')
            ->assertJsonPath('data.is_read', false);

        $this->assertDatabaseHas('inquiries', [
            'email' => 'an@example.com',
            'is_read' => false,
        ]);
    }

    public function test_home_and_settings_endpoints_return_json(): void
    {
        $this->getJson('/api/v1/home')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'site',
                    'settings',
                    'categories',
                    'featured_products',
                    'latest_posts',
                    'testimonials',
                ],
            ]);

        $this->getJson('/api/v1/settings')
            ->assertOk()
            ->assertJsonStructure(['data' => ['floating_phone', 'show_floating_bar']]);
    }
}
