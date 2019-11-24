<div class="checkbox {{ $class }} margin-top-7">
   <label>
      <input type="checkbox" name="{{ $name }}" @if($checked) checked="checked" @endif @if($disabled) disabled="disabled" @endif>
      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
      {{ $label }}
   </label>
</div>
@if($showError)
   @if ($errors->has($name))
      <p class="help-block">{{ $errors->first($name) }}</p>
   @endif
@endif
