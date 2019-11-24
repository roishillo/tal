<div class="form-group @if ($errors->has($name)): has-error @endif">
    @if($label)
        {{ Form::label($name, $label, ['class' => 'control-label']) }}<br />
    @endif
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if($showError)
        @if ($errors->has($name))
            <p class="help-block">{{ $errors->first($name) }}</p>
        @endif
    @endif
</div>
