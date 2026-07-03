<x-admin-layout title="Sửa dự án">
    <div class="max-w-3xl rounded-xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6"
              x-data="{ specs: {{ Illuminate\Support\Js::from(old('specifications', $product->specifications ?: [['key' => '', 'value' => '']])) }} }">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label class="label">Tên dự án</label>
                    <input type="text" name="title" required value="{{ old('title', $product->title) }}" class="input">
                    @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Đường dẫn</label>
                    <input type="text" name="slug" required value="{{ old('slug', $product->slug) }}" class="input">
                    @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Mã dự án</label>
                    <input type="text" name="model_number" value="{{ old('model_number', $product->model_number) }}" class="input">
                </div>
                <div>
                    <label class="label">Danh mục</label>
                    <select name="category_id" required class="input">
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="label">Ảnh dự án</label>
                @if($product->image)
                    <img src="{{ $product->image_url }}" class="mb-3 h-24 w-24 rounded-md object-cover">
                @endif
                <input type="file" name="image" accept="image/*" class="input">
                @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1 text-xs text-gray-400">Để trống nếu muốn giữ ảnh hiện tại.</p>
            </div>

            <div>
                <label class="label">Mô tả</label>
                <textarea name="description" rows="5" class="input">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <div class="mb-3 flex items-center justify-between">
                    <label class="label !mb-0">Thông số kỹ thuật</label>
                    <button type="button" @click="specs.push({ key: '', value: '' })" class="text-sm font-semibold text-gold hover:text-gold-dark">+ Thêm thông số</button>
                </div>
                <div class="space-y-3">
                    <template x-for="(spec, index) in specs" :key="index">
                        <div class="flex gap-3">
                            <input type="text" :name="`specifications[${index}][key]`" x-model="spec.key" placeholder="Ví dụ: Công suất động cơ" class="input">
                            <input type="text" :name="`specifications[${index}][value]`" x-model="spec.value" placeholder="Ví dụ: 250 HP" class="input">
                            <button type="button" @click="specs.splice(index, 1)" class="flex-none rounded-md px-3 text-red-500 hover:bg-red-50">✕</button>
                        </div>
                    </template>
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-gold focus:ring-gold" @checked(old('is_featured', $product->is_featured))>
                Ghim dự án này trên trang chủ
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-secondary">Cập nhật dự án</button>
                <a href="{{ route('admin.products.index') }}" class="btn-outline !text-charcoal !border-gray-300">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
