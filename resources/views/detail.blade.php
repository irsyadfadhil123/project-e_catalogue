<x-layout>
    <!--
      This example requires some changes to your config:

      ```
      // tailwind.config.js
      module.exports = {
        // ...
        theme: {
          extend: {
            gridTemplateRows: {
              '[auto,auto,1fr]': 'auto auto 1fr',
            },
          },
        },
      }
      ```
    -->
    <div class="bg-white">
        <div class="pt-6">
            <!-- Product info -->
            <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $details['title'] }}</h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>
                    <img src="{{ $details['images'][0] }}" alt="Image not found." class="aspect-square w-full rounded-lg bg-gray-200 object-cover xl:aspect-7/8">
                    <p class="mt-2 text-3xl tracking-tight text-gray-900">${{ $details['price'] }}</p>
                    <p class="mt-2 text-lg text-gray-600">Stock: {{ $details['stock'] ?? '-' }}</p>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>

                        <div class="space-y-6">
                            <p class="text-base text-gray-900">{{ $details['description'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h2 class="text-lg font-medium text-gray-900">Brand</h2>

                        <div class="mt-4 space-y-6">
                            <p class="text-sm text-gray-600">{{ $details['brand'] ?? 'No Brand' }}</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h2 class="text-lg font-medium text-gray-900">Category</h2>

                        <div class="mt-4 space-y-6">
                            <p class="text-sm text-gray-600">{{ $details['category'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-lg font-medium text-gray-900">Dimensions</h3>

                        <div class="mt-4">
                            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                <li class="text-gray-400"><span class="text-gray-600">Width: {{ $details['dimensions']['width'] ?? '-' }}</span></li>
                                <li class="text-gray-400"><span class="text-gray-600">Height: {{ $details['dimensions']['height'] ?? '-' }}</span></li>
                                <li class="text-gray-400"><span class="text-gray-600">Depth: {{ $details['dimensions']['depth'] ?? '-' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
