@props(['type' => 'button'])

<button type="{{ $type }}" {{ $attributes(['class' => 'btn btn-primary']) }} {{ $attributes }}>
    {{ $slot }}
</button>
