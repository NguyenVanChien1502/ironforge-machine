<x-admin-layout title="Sửa đánh giá">
    <div class="max-w-2xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="label">Tên khách hàng</label>
                <input type="text" name="customer_name" required value="{{ old('customer_name', $testimonial->customer_name) }}" class="input" placeholder="Ví dụ: Nguyễn Văn A">
                @error('customer_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Công ty / chức danh</label>
                <input type="text" name="company" value="{{ old('company', $testimonial->company) }}" class="input" placeholder="Ví dụ: Công ty ABC">
                @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Đánh giá sao</label>
                <select name="rating" class="input">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ $i }} sao</option>
                    @endfor
                </select>
                @error('rating') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Nội dung phản hồi</label>
                <textarea name="content" rows="4" required class="input" placeholder="Nhập nội dung đánh giá của khách hàng...">{{ old('content', $testimonial->content) }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Ảnh đại diện (không bắt buộc)</label>
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ $testimonial->avatar_url }}" alt="Ảnh hiện tại" class="h-12 w-12 rounded-full border border-gray-200 object-cover">
                    <span class="text-xs text-gray-500">Ảnh đại diện hiện tại</span>
                </div>
                <input type="file" name="avatar" class="input py-2">
                <p class="mt-1 text-xs text-gray-400">Hỗ trợ JPG, PNG, WEBP. Tối đa 2MB. Để trống nếu muốn giữ ảnh hiện tại.</p>
                @error('avatar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $testimonial->is_visible)) class="h-4 w-4 rounded border-gray-300 text-gold focus:ring-gold">
                    <span class="ml-2 text-sm font-medium text-gray-700">Hiển thị công khai trên website</span>
                </label>
            </div>

            <div class="flex gap-3 border-t border-gray-100 pt-4">
                <button type="submit" class="btn-secondary">Cập nhật đánh giá</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-outline !text-charcoal !border-gray-300">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
