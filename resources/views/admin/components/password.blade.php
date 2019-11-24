<div class="form-group m-form__group row @if ($errors->has($name)): has-error @endif">
    {{ Form::label($name, $title, ['class' => 'col-2 col-form-label']) }}
    <div class="col-7">
    {{ Form::password($name, array_merge(['class' => 'form-control m-input'], $attributes)) }}
    </div>
</div>
@if ($errors->has($name))
    <p class="help-block" style="color:red;">{{ $errors->first($name) }}</p>
@endif