<div id="toast-container" class="fixed z-50 flex flex-col w-full max-w-sm gap-3 top-6 right-6">

    @if (session('success'))
        <div data-toast="success" data-message="{{ session('success') }}"></div>
    @endif

    @if (session('error'))
        <div data-toast="error" data-message="{{ session('error') }}"></div>
    @endif
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                document.querySelectorAll('[data-toast]').forEach(el => {
                    createToast(el.dataset.toast, el.dataset.message)
                })

                function createToast(type, message) {
                    const container = document.getElementById('toast-container')
                    const isSuccess = type === 'success'

                    const toast = document.createElement('div')

                    // initial state (off-screen)
                    toast.className =
                        `flex items-start px-6 py-4 text-sm border-l-4 rounded shadow-md
                        transform translate-x-full opacity-0
                        transition-all duration-300 ease-out
                        ${isSuccess
                            ? 'bg-green-50 border-green-500'
                            : 'bg-red-50 border-red-500'
                        }`


                    toast.innerHTML = `
                        <svg class="w-8 h-8 ${isSuccess ? 'text-green-500' : 'text-red-500'}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${isSuccess
                                ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                     d="M5 13l4 4L19 7"/>`
                                : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                     d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>`
                            }
                        </svg>
                        <div class="ml-3">
                            <div class="font-bold text-black">
                                ${isSuccess ? 'Berhasil' : 'Gagal'}
                            </div>
                            <div class="mt-1 text-gray-700">
                                ${message}
                            </div>
                        </div>
                    `

                    container.appendChild(toast)

                    // trigger slide-in
                    requestAnimationFrame(() => {
                        toast.classList.remove('translate-x-full', 'opacity-0')
                        toast.classList.add('translate-x-0', 'opacity-100')
                    })

                    // auto hide
                    setTimeout(() => {
                        toast.classList.remove('translate-x-0', 'opacity-100')
                        toast.classList.add('translate-x-full', 'opacity-0')

                        setTimeout(() => toast.remove(), 500)
                    }, 4000)
                }
            })
        </script>
    @endpush
@endonce
