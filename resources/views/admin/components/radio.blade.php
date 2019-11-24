
@if($label) {{ Form::label($name, $label, ['class' => 'control-label']) }} @endif
{{ Form::radio($name, $options, $checked,  $label, array_merge(['class' => 'form-control'], $attributes)) }}
@if($showError)
   @if ($errors->has($name))
      <p class="help-block">{{ $errors->first($name) }}</p>
   @endif
@endif
