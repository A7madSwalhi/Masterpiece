@props([
    'name', 'options', 'checked' => false, 'required' => false,
])



@foreach($options as $value => $text)

<div class="form-check">
    <input id="{{$text}}" class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}"
        @checked(old($name, $checked) == $value)
        {{ $attributes->class([
            'form-check-input',
            'is-invalid' => $errors->has($name)
        ]) }}
    >
    <label class="form-check-label" for="{{$text}}">
        {{ $text }}
    </label>
</div>

@endforeach

<x-form.validation-feedback :name="$name" />
