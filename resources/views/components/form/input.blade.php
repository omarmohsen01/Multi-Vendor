@props([
    'type'=>'text','name','value'=>false,'label'=>false,'placeholder'=>false
])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<input type="{{ $type }}" name="{{ $name }}" 
    class="form-control m-1" style="width: 250px" placeholder="{{ $placeholder }}"
    value="{{ old($name, $value) }}">
@error($name)
    <div class="text-danger" style="width: 450px">{{ $message }}</div>
@enderror 