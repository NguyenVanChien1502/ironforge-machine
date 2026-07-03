<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function index(Request $request)
    {
        $posts = $this->query($request)
            ->paginate($this->perPage($request, 10))
            ->withQueryString();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return response()->json([
            'data' => new PostResource($post),
            'related_posts' => PostResource::collection($relatedPosts),
        ]);
    }

    private function query(Request $request): Builder
    {
        $query = Post::published()->latest('published_at');

        if ($search = trim((string) $request->string('search'))) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    private function perPage(Request $request, int $default): int
    {
        return max(1, min((int) $request->integer('per_page', $default), 100));
    }
}
