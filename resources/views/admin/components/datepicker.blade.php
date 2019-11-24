<div class="form-group @if ($errors->has($name)): has-error @endif" >
    @if($label)
        {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @endif
    <div class="input-group date date-picker" {!! isset($defaults['date']) ? 'data-date="' . $defaults['date'] . '"' : '' !!} {!! isset($defaults['format']) ? 'data-date-format="'. $defaults['format'] . '"' : 'data-date-format="dd/mm/yyyy"' !!} {!! isset($defaults['viewmode']) ? 'data-date-viewmode="' . $defaults['viewmode'] . '"' : '' !!}>
        {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
        <span class="input-group-btn">
            <button class="btn default" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
    </div>
    @if ($errors->has($name))
        <p class="help-block">{{ $errors->first($name) }}</p>
    @endif
</div>