@props(['name', 'type' => 'text', 'label' => false, 'label_text' => null])

<div class="form-group">
    @if($label)
        <label for="{{ rtrim($name, '[]') }}">{{ ucwords($label_text ?: rtrim($name, '[]')) }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}"
           id="{{ rtrim($name, '[]') }}" {{ $attributes(['class' => 'form-control']) }} {{ $attributes }}/>
    <x-form.error :name="rtrim($name, '[]')"/>
</div>




