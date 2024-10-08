@props([
    'name',
    'selected' => '',
    'options',
    'required' => false ,
    'id' => ''
])



<select
    @if ($id)
        id ="{{$id}}"
    @endif
    name="{{ $name }}"
    {{ $attributes->class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name)
    ]) }}
    @if($required) required @endif
>
    <option value="">Choose</option>
    @foreach($options as $value => $text)
        <option value="{{ $value }}" @selected( @old($name,$selected) == $value)>{{ $text }}</option>

    @endforeach
</select>

<x-form.validation-feedback :name="$name" />
