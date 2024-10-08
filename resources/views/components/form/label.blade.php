@props([
    'id' => '',
])

<label for="{{ $id }}"
        {{ $attributes->class([
            'form-label', 
        ])->merge(['class' => '']) }}
>{{ $slot }}</label>
