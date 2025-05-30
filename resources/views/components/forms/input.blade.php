<label for="{{ $name ?? '' }}">{{ $slot }}</label>
<input
    type="{{ $type ?? 'text' }}"
    name="{{ $name ?? '' }}"
    id="{{ $name ?? '' }}"
    class="form-control {{ $class ?? '' }}"
    placeholder="{{ $placeholder ?? '' }}"
    value="{{ old($name, $value ?? '') }}"
    {{ $attributes->merge(['autocomplete' => 'off']) }}
    @if(isset($required) && $required) required @endif
    @if(isset($disabled) && $disabled) disabled @endif
    @if(isset($readonly) && $readonly) readonly @endif
    @if(isset($autofocus) && $autofocus) autofocus @endif
    @if(isset($maxlength) && $maxlength) maxlength="{{ $maxlength }}" @endif
    @if(isset($minlength) && $minlength) minlength="{{ $minlength }}" @endif
    @if(isset($pattern) && $pattern) pattern="{{ $pattern }}" @endif
>