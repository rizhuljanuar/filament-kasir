<div class="grid grid-cols-1 gap-4 md:grid-cols-3 dark:bg-gray-900">
    <div class="p-6 bg-white rounded-lg shadow-md md:col-span-2 dark:bg-gray-800">
        <div class="flex gap-2 mb-4">
            <input wire:model.live.debounce.300ms='search' type="text" placeholder="Cari produk..."
                class="p-2 w-full text-gray-900 bg-white rounded-lg border border-gray-300 dark:text-gray-100 dark:bg-gray-900 dark:border-gray-700">
            <x-filament::button x-data="" x-on:click="$dispatch('toggle-scanner')" color="primary">
                Scan Barcode
            </x-filament::button>
            <livewire:scanner-modal-component />
        </div>
        <div class="flex-grow">
            <div class="grid grid-cols-8 gap-4 sm:grid-cols-3 md:grid-cols-8 lg:grid-cols-">
                @foreach ($products as $item)
                    <div wire:click="addToOrder({{ $item->id }})"
                        class="p-4 bg-gray-100 rounded-lg shadow cursor-pointer dark:bg-gray-700">
                        <img src="{{ $item->image_url }}" alt="Product Image"
                            class="object-cover mb-2 w-full h-16 rounded-lg">
                        <h3 class="text-sm font-semibold">{{ $item->name }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Rp.
                            {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Stok: {{ $item->stock }}</p>
                    </div>
                @endforeach

            </div>
            <div class="py-4">
                {{ $products->links() }}

            </div>

        </div>
    </div>
    <div class="p-6 bg-white rounded-lg shadow-md md:col-span-1 dark:bg-gray-800">
        @if (count($order_items) > 0)
            <div class="py-4">
                <h3 class="text-lg font-semibold text-center">Total: Rp
                    {{ number_format($this->calculateTotal(), 0, ',', '.') }}</h3>
            </div>
        @endif
        @foreach ($order_items as $item)
            <div class="mb-4">
                <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center">
                        <img src="{{ $item['image_url'] }}" alt="Product Image"
                            class="object-cover mr-2 w-10 h-10 rounded-lg">
                        <div class="px-2">
                            <h3 class="text-sm font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Rp
                                {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <x-filament::button color="warning"
                            wire:click="decreaseQuantity({{ $item['product_id'] }})">-</x-filament::button>
                        <span class="px-4">{{ $item['quantity'] }}</span>
                        <x-filament::button color="success"
                            wire:click="increaseQuantity({{ $item['product_id'] }})">+</x-filament::button>
                    </div>
                </div>
            </div>
        @endforeach
        <form wire:submit="checkout">
            {{ $this->form }}
            <x-filament::button type="submit"
                class="py-2 mt-3 w-full text-white bg-red-500 rounded">Checkout</x-filament::button>

        </form>

        <div class="mt-2">

        </div>
    </div>
</div>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
