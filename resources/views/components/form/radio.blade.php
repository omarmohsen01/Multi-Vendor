@props([
    'name','options','checked'=>false,'label'=>false
])
@if ($label)
<label for="">{{ $label }}</label>
@endif
@foreach($options as $value => $text)
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}" 
    @checked(old($name,$checked)==$value)> 
    <label class="form-check-label" for="flexRadioDefault1">
      {{ $text }}
    </label>
  </div>
@endforeach
@error($name)
    <div class="text-danger" style="width: 450px">{{ $message }}</div>
@enderror 