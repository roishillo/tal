@inject('countries', 'App\Models\Country')

@php($class = isset($class) ? $class : '')
<div class="form-group {{ $class }}">
    <label class="control-label">Country: </label>
    <div class="input_container">
        <div class="select2-container-repeater">
            <select class="select2-input form-control" data-name="{{ $name }}" name="{{ $name }}">
                <option value=""></option>
                @foreach($countries->all() as $country)
                    <option value="{{ $country->iso_code }}" @if($country->iso_code == $value) selected @endif>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>