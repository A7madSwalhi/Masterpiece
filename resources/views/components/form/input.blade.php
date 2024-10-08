@props([
    'type' => 'text', 'name', 'value' => '', 'required' => false, 'placeholder' => '','id'=>''
])


<input
    id="{{$id}}"
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ]) }}
    @if($required) required @endif
    @if($placeholder)
    placeholder="{{$placeholder}}"
    @endif
>



<x-form.validation-feedback :name="$name" />
