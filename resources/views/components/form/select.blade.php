@props([
    'name','options','value'=>false,'label'=>false,'selected'=>false
])
@if ($label)
<label for="">{{ $label }}</label>
@endif

<select name="{{ $name }}" class="form-control @error('{{ $name }}')
                    is-invalid @enderror" style="width: 250px">
        <option value="">primary category</option>
        @foreach ($options as $value=>$text)
            <option value="{{ $value }}" @selected($value == $selected)>
                    {{ $text }}</option>
        @endforeach
    </select>
@error('parent_id')
    <div class="text-danger" style="width: 450px">{{ $message }}</div>
@enderror