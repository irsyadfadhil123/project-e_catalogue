<x-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
            <p class="text-2xl my-2 font-bold">Products</p>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <a href="/product/{{ $product['id'] }}?category={{ $product['category'] }}" class="group">
                        <img src="{{ $product['image'] }}" alt="Image not found." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8">
                        <h3 class="mt-4 text-sm text-gray-700">{{ $product['brand'] ?? 'No Brand' }}</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $product['title'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
