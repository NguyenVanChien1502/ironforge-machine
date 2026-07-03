<x-admin-layout title="Thêm danh mục">
    <div class="max-w-xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
            @csrf
            <div>
                <label class="label">Tên danh mục</label>
                <input type="text" name="name" required value="{{ old('name') }}" class="input">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label">Đường dẫn</label>
                <input type="text" name="slug" required value="{{ old('slug') }}" class="input">
                @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-secondary">Lưu danh mục</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-outline !text-charcoal !border-gray-300">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
