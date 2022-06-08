@if (session()->has('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 6000)"
         x-show="show"
         class="flash-message"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif