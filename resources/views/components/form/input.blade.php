@props([
    'type' => 'text', 'name', 'value' => ' ', 'required' => false, 'placeholder' => '', 'id'=>''
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

    @if($placeholder)
    placeholder="{{$placeholder}}"
    @endif

    @if($required) required @endif

    {{ $attributes->except('class') }}

>



<x-form.validation-feedback :name="$name" />
