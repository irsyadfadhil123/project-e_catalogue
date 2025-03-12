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
                    <p class="mt-2 text-sm text-gray-600">Stock: {{ $details['stock'] ?? '-' }}</p>
                    <div class="mt-1">
                        <div class="mt-4 space-y-6">
                            <p class="text-base text-gray-800">{{ $promotion['candidates'][0]['content']['parts'][0]['text'] ?? 'Tulalit tulalit tulalit' }}</p>
                        </div>
                    </div>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>

                        <div class="space-y-6">
                            <p class="text-xl text-gray-900">{{ $details['description'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h2 class="text-xl font-medium text-gray-900">Brand</h2>

                        <div class="mt-4 space-y-6">
                            <p class="text-lg text-gray-600">{{ $details['brand'] ?? 'No Brand' }}</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-xl font-medium text-gray-900">Dimensions</h3>

                        <div class="mt-4">
                            <ul role="list" class="list-disc space-y-2 pl-4 text-lg">
                                <li class="text-gray-400"><span class="text-gray-600">Width: {{ $details['dimensions']['width'] ?? '-' }}</span></li>
                                <li class="text-gray-400"><span class="text-gray-600">Height: {{ $details['dimensions']['height'] ?? '-' }}</span></li>
                                <li class="text-gray-400"><span class="text-gray-600">Depth: {{ $details['dimensions']['depth'] ?? '-' }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h2 class="mb-2 text-xl font-medium text-gray-900">Modify Product</h2>
                        <div class="mb-2 space-y-6">
                            <p class="text-lg text-gray-600">Edit or Delete this Product</p>
                        </div>

                        <div x-data="{ open: false }" class="inline-block mr-2">
                            <!-- Tombol untuk membuka modal -->
                            <button @click="open = true" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</button>

                            <!-- Modal -->
                            <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <!-- Background backdrop -->
                                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" x-show="open" x-transition.opacity></div>

                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <!-- Modal panel -->
                                        <div x-show="open" x-transition:enter="ease-out duration-300"
                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave="ease-in duration-200"
                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full max-w-4xl"
                                             @click.away="open = false">

                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 w-full">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:size-10">
                                                        <svg class="size-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.34 2.34 0 0 1 3.309 3.309L7.28 19.687 3 21l1.313-4.28L16.862 3.487Z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Edit Product</h3>
                                                        <p class="mt-1 text-sm text-gray-600">Edit your product in the catalogue.</p>
                                                        <form action="/product/{{ $details['id'] }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mt-4 space-y-4">
                                                                <div>
                                                                    <label for="title" class="block text-sm font-medium text-gray-900">Title</label>
                                                                    <input required id="title" name="title" type="text" value="{{ $details['title'] }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-indigo-600">
                                                                </div>
                                                                <div>
                                                                    <label for="brand" class="block text-sm font-medium text-gray-900">Brand</label>
                                                                    <input id="brand" name="brand" type="text" value="{{ $details['brand'] }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-indigo-600">
                                                                </div>
                                                                <div>
                                                                    <label for="price" class="block text-sm font-medium text-gray-900">Price</label>
                                                                    <div class="flex items-center rounded-md bg-white px-3 py-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-indigo-600">
                                                                        <span class="text-gray-500">$</span>
                                                                        <input required type="number" name="price" id="price" value="{{ $details['price'] }}" class="block w-full pl-2 text-base text-gray-900 placeholder-gray-400 focus:outline-none" placeholder="59.00">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                                                                    <textarea name="description" id="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-indigo-600">{{ $details['description'] }}</textarea>
                                                                    <p class="mt-1 text-sm text-gray-600">Write a few sentences about the product.</p>
                                                                </div>
                                                            </div>
                                                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                                                <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-300 sm:mt-0 sm:w-auto">Cancel</button>
                                                                <button type="submit" class="rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-600">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }" class="inline-block">
                            <!-- Tombol untuk membuka modal -->
                            <button @click="open = true" class="mt-1 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>

                            <!-- Modal -->
                            <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <!-- Background backdrop -->
                                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" x-show="open" x-transition.opacity></div>

                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <!-- Modal panel -->
                                        <div x-show="open" x-transition:enter="ease-out duration-300"
                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave="ease-in duration-200"
                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                             class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                                             @click.away="open = false">

                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Delete Product?</h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">Are you sure you want to delete this product? All product data will be permanently removed. This action cannot be undone.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                <form action="/product/{{ $details['id'] }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-600 sm:ml-3 sm:w-auto">Delete</button>
                                                </form>
                                                <button @click="open = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-300 sm:mt-0 sm:w-auto">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div x-data="{ open: true }">
            <!-- Modal -->
            <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Background backdrop -->
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" x-show="open" x-transition.opacity></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <!-- Modal panel -->
                        <div x-show="open" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                             @click.away="open = false">

                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                        <svg class="size-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Modify Product Success</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button @click="open = false" type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 sm:ml-3 sm:w-auto">OK</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('failure'))
        <div x-data="{ open: true }">
            <!-- Modal -->
            <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Background backdrop -->
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" x-show="open" x-transition.opacity></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <!-- Modal panel -->
                        <div x-show="open" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                             @click.away="open = false">

                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Modify Product Failed</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">{{ session('failure') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button @click="open = false" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">OK</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-layout>
