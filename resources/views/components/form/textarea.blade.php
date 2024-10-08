@props([
    'name', 'value' => '', 'required' => false,'placeholder' => ''
])




<textarea

    name="{{ $name }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ]) }}
    @if($placeholder)
    placeholder="{{$placeholder}}"
    @endif
    @if($required) required @endif
>{{ old($name, $value) }}</textarea>


<x-form.validation-feedback :name="$name" />
