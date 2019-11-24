<div class="form-group  @if ($errors->has($name)) has-error @endif">
    @if($label)
        {{ Form::label($name, $label, null, ['class' => 'control-label']) }}
    @endif
    {{ Form::select($name, $options, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if($showError)
        @if ($errors->has($name))
                <p class="help-block">{{ $errors->first($name) }}</p>
        @endif
    @endif
</div>
