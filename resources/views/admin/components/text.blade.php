
    @if($label)
        {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @endif
    {{ Form::text($name, $value, array_merge(['class' => 'form-control m-input'], $attributes)) }}
    @if($showError)
        @if ($errors->has(convert_input_to_dot_separated_array($name)))
            <p class="help-block">{{ $errors->first(convert_input_to_dot_separated_array($name)) }}</p>
        @endif
    @endif
