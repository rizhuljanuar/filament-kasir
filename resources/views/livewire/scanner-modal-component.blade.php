<div>
    <div x-data="{
        open: false,
        scanner: null
    }"
        x-on:toggle-scanner.window="
        open = !open;
        if (open) {
            $nextTick(() => {
                scanner = new Html5Qrcode('reader');
                scanner.start(
                    { facingMode: 'environment' },
                    {
                        fps: 30,
                        qrbox: { width: 450, height: 450 }
                    },
                    (decodedText) => {
                        $wire.dispatch('scanResult', { decodedText: decodedText });
                        scanner.stop();
                        open = false;
                    },
                    (error) => console.warn(error)
                );
            });
        } else if (scanner) {
            scanner.stop();
        }
    "
        x-show="open" class="flex fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-6 w-full max-w-lg bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <h2 class="mb-4 text-lg font-semibold">QR Code Scanner</h2>
            <div id="reader" class="w-full"></div>
            <button @click="open = false; if (scanner) scanner.stop();"
                class="absolute top-0 right-0 m-2 text-gray-600 dark:text-gray-400 hover:text-gray-900">
                &times;
            </button>
        </div>
    </div>
</div>
