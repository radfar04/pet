<div {{ $attributes->merge(['class' => 'container mx-auto p-60 rounded-lg shadow-lg']) }}>
   <div class="text-xl text-yellow-500">{{ $title }}</div>
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>