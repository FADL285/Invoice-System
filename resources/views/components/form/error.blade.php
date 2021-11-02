@props(['name'])

@error($name)
<span class="help-block text-danger">{{ $message }}</span>
@enderror
