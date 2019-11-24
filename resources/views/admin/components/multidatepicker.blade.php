<div data-test="{{ $key['name'] . '.' . $key['id'] }}" class="form-group @if ($errors->has($key['name'] . '.' . $key['id']))): has-error @endif">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}

    <div class="input-group date date-picker" {!! isset($defaults['date']) ? 'data-date="' . $defaults['date'] . '"' : '' !!} {!! isset($defaults['format']) ? 'data-date-format="' . $defaults['format'] . '"' : '' !!} {!! isset($defaults['viewmode']) ? 'data-date-viewmode="' . $defaults['viewmode'] . '"' : '' !!}>
        {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
        <span class="input-group-btn">
            <button class="btn default" type="button" style="height:34px;">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
    </div>

    @if ($errors->has($key['name'] . '.' . $key['id']))
        <p class="help-block">{{ $errors->first($key['name'] . '.' . $key['id']) }}</p>
    @endif
</div>
