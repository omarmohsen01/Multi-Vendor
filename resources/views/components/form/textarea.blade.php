@props([
    'name','value'=>false,'label'=>false
])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<textarea name="{{ $name }}" 
    class="form-control" style="width: 450px" 
>{{ old($name, $value) }}</textarea>
@error($name)
    <div class="text-danger" style="width: 450px">{{ $message }}</div>
@enderror 