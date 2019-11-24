<div data-test="{{ $key['name'] . '.' . $key['id'] }}" class="form-group @if ($errors->has($key['name'] . '.' . $key['id']))): has-error @endif">
    @if($label)
        {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @endif
    {{ Form::email($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if ($errors->has($key['name'] . '.' . $key['id']))
        <p class="help-block">{{ $errors->first($key['name'] . '.' . $key['id']) }}</p>
    @endif
</div>
