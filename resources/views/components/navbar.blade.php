<div>
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
            </div>
            <div class="flex lg:hidden">
            </div>
            <div class="lg:flex lg:gap-x-12">
                <a href="/" class="text-sm/6 font-semibold text-gray-900">Home</a>
                <a href="{{ route('product.index') }}" class="text-sm/6 font-semibold text-gray-900">Catalogue</a>
                <a href="{{ route('product.create') }}" class="text-sm/6 font-semibold text-gray-900">Add Product</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            </div>
        </nav>
    </header>
</div>
