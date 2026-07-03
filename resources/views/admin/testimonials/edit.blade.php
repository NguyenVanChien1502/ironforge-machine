<x-admin-layout title="Edit Testimonial">
    <div class="max-w-2xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="label">Customer Name</label>
                <input type="text" name="customer_name" required value="{{ old('customer_name', $testimonial->customer_name) }}" class="input" placeholder="e.g. John Doe">
                @error('customer_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Company / Designation</label>
                <input type="text" name="company" value="{{ old('company', $testimonial->company) }}" class="input" placeholder="e.g. Acme Construction Group">
                @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Rating (Stars)</label>
                <select name="rating" class="input">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ $i }} Stars</option>
                    @endfor
                </select>
                @error('rating') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Feedback Content</label>
                <textarea name="content" rows="4" required class="input" placeholder="Write customer feedback here...">{{ old('content', $testimonial->content) }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Customer Avatar (Optional)</label>
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ $testimonial->avatar_url }}" alt="Current Avatar" class="h-12 w-12 rounded-full object-cover border border-gray-200">
                    <span class="text-xs text-gray-500">Current customer avatar</span>
                </div>
                <input type="file" name="avatar" class="input py-2">
                <p class="mt-1 text-xs text-gray-400">Supported formats: JPG, PNG, WEBP. Max size: 2MB. Leave empty to keep current avatar.</p>
                @error('avatar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $testimonial->is_visible)) class="rounded border-gray-300 text-gold focus:ring-gold h-4 w-4">
                    <span class="ml-2 text-sm font-medium text-gray-700">Display publicly on website</span>
                </label>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-secondary">Update Testimonial</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-outline !text-charcoal !border-gray-300">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>
