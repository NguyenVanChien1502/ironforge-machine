<x-admin-layout title="Edit Article: {{ $post->title }}">
    <div class="max-w-3xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="label">Title</label>
                <input type="text" name="title" required value="{{ old('title', $post->title) }}" class="input" placeholder="Enter article title">
                @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Slug</label>
                <input type="text" name="slug" required value="{{ old('slug', $post->slug) }}" class="input" placeholder="article-slug">
                @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Excerpt (Brief Summary)</label>
                <textarea name="excerpt" rows="2" class="input" placeholder="Write a short summary for search results and previews">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Body Content</label>
                <textarea name="body" rows="10" required class="input" placeholder="Write the full content of the article here...">{{ old('body', $post->body) }}</textarea>
                @error('body') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Featured Image</label>
                @if($post->image)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ Storage::disk('public')->url($post->image) }}" alt="Current Image" class="h-20 w-32 rounded object-cover border border-gray-200">
                        <span class="text-xs text-gray-500">Current featured image</span>
                    </div>
                @endif
                <input type="file" name="image" class="input py-2">
                <p class="mt-1 text-xs text-gray-400">Supported formats: JPG, PNG, WEBP. Max size: 4MB. Leave blank to keep current image.</p>
                @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label class="label">Published Date (Optional)</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="input">
                    <p class="mt-1 text-xs text-gray-400">Leave blank to set to current time when published.</p>
                    @error('published_at') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center pt-8">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published)) class="rounded border-gray-300 text-gold focus:ring-gold h-4 w-4">
                        <span class="ml-2 text-sm font-medium text-gray-700">Publish immediately</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-secondary">Update Article</button>
                <a href="{{ route('admin.posts.index') }}" class="btn-outline !text-charcoal !border-gray-300">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
            str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
            str = str.replace(/đ/g,"d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            return str;
        }

        document.querySelector('input[name="title"]').addEventListener('input', function() {
            let cleanVal = removeVietnameseTones(this.value);
            let slug = cleanVal.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.querySelector('input[name="slug"]').value = slug;
        });
    </script>
</x-admin-layout>
