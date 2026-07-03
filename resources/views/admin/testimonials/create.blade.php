<x-admin-layout title="Thêm đánh giá">
    <div class="max-w-2xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="label">Tên khách hàng</label>
                <input type="text" name="customer_name" required value="{{ old('customer_name') }}" class="input" placeholder="Ví dụ: Nguyễn Văn A">
                @error('customer_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Công ty / chức danh</label>
                <input type="text" name="company" value="{{ old('company') }}" class="input" placeholder="Ví dụ: Công ty ABC">
                @error('company') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Đánh giá sao</label>
                <select name="rating" class="input">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', 5) == $i)>{{ $i }} sao</option>
                    @endfor
                </select>
                @error('rating') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Nội dung phản hồi</label>
                <textarea name="content" rows="4" required class="input" placeholder="Nhập nội dung đánh giá của khách hàng...">{{ old('content') }}</textarea>
                @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="label">Ảnh đại diện (không bắt buộc)</label>
                <input type="file" name="avatar" class="input py-2">
                <p class="mt-1 text-xs text-gray-400">Hỗ trợ JPG, PNG, WEBP. Tối đa 2MB. Để trống để dùng avatar chữ cái.</p>
                @error('avatar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', true)) class="h-4 w-4 rounded border-gray-300 text-gold focus:ring-gold">
                    <span class="ml-2 text-sm font-medium text-gray-700">Hiển thị công khai trên website</span>
                </label>
            </div>

            <div class="flex gap-3 border-t border-gray-100 pt-4">
                <button type="submit" class="btn-secondary">Lưu đánh giá</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-outline !text-charcoal !border-gray-300">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
