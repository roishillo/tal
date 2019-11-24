@inject('pages', 'App\Models\Core\Page')

@inject('CoreLinks', 'App\CoreHelpers\CoreLinks')

@if(old(convert_input_to_dot_separated_array($name)))
    @php($value = old(convert_input_to_dot_separated_array($name)))
@endif

@php($elementId = uniqid('links-wrapper-'))

<!-- shortcut for long named function  -->
@php($citdsa = function ($value) use ($dotSeparated) {
        return $dotSeparated ? convert_input_to_dot_separated_array($value) : $value;
    })

<div class="injected_pages_container" id="{{$elementId}}">
    <div class="external_link_select">
        <select class="select2 form-control selected-option" name="{{ $citdsa($name.'[selected_option]') }}">
            <optgroup label="Pages">
                @foreach($pages->all() as $loop_page)
                    <option value="{{ $loop_page->id }}" {{array_get($value, 'selected_option') == $loop_page->id ? 'selected' : ''}}>{{ $loop_page->system_name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="General">
                <option value="external" {{array_get($value, 'selected_option') == 'external' ? 'selected' : ''}}>External Link</option>
                <option value="no_link" {{array_get($value, 'selected_option') == 'no_link' ? 'selected' : ''}}>Without Link</option>
            </optgroup>
        </select>
    </div>
    <div class="@if(array_get($value, 'selected_option') != 'external') hide @endif external_link">
        <label class="control-label">Location: </label>
        <div class="input_container">
            <div class="col-xs-6 without_padding">
                <input name="{{ $citdsa($name.'[external_link]') }}" class="form-control" value="{{array_get($value, 'external_link')}}">
            </div>
            <div class="col-xs-6 without_padding">
                <select name="{{ $citdsa($name.'[new_window]') }}" class="form-control">
                    <option value="false" {{array_get($value, 'new_window') == 'false' ? 'selected' : ''}}>Open In The Current Window</option>
                    <option value="true"  {{array_get($value, 'new_window') == 'true' ? 'selected' : ''}} >Open In New Window</option>
                </select>
            </div>
        </div>
    </div>
    <div class="@if(in_array(array_get($value, 'selected_option') , ['no_link', 'external_link'])) hide @endif inner_link">

        <label class="control-label">Query Params: (comma separated, ex: itemId=1,pageId=3)</label>
        <div class="row">
            <div class="input_container">
                <div class="col-xs-12 without_padding">
                    <input name="{{ $citdsa($name.'[query_params]') }}" class="form-control" value="{{array_get($value, 'query_params')}}">
                </div>
            </div>
        </div>

        <label class="control-label">Route Params: (comma separated, ex: itemId=1,pageId=3)</label>
        <div class="row">
            <div class="input_container">
                <div class="col-xs-12 without_padding">
                    <input name="{{ $citdsa($name.'[route_params]') }}" class="form-control route-params" value="{{array_get($value, 'route_params')}}">
                </div>
            </div>
        </div>

        <div class="entities-parameters">
            <div class="row">
                <label class="col-xs-10 control-label"><span class="pull-left">Add a route param dynamically:</span></label>
                <label class="col-xs-2 control-label">
                        <button class="btn btn-success btn-outline pull-right add-button btn-xs">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                </label>
            </div>
            <div class="row">
                <label class="col-xs-4 control-label"><span class="pull-left">Parameter Name</span></label>
                <label class="col-xs-4 control-label"><span class="pull-left">Entity</span></label>
                <label class="col-xs-4 control-label"><span class="pull-left">Item</span></label>
            </div>
            <div class="row entity-parameter-row">
                <div class="col-xs-4">
                    <input type="text" name="parameter_name" class="form-control entity-param-name"/>
                </div>

                <div class="col-xs-4">
                    <select name="entity" class="form-control entity-select">
                        @foreach($CoreLinks::getLinkableModels() as $modelName => $className)
                            <option value="{{$modelName}}">{{studly_case($modelName)}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-4">
                    @foreach($CoreLinks::getLinkableModels() as $modelName => $className)
                        <div class="entity-item-list entity-item-{{$modelName}}">
                            <select name="selects.{{ $modelName }}" class="form-control" data-entity="{{$modelName}}">
                            </select>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<style type="text/css">
    .injected_pages_container .input_container {
        border-left: none !important;
    }
    .injected_pages_container .form-group {
        border-bottom: none !important;
    }
</style>

@push('freeScripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {

            LinksComponent.init('{{$elementId}}');
        });
    </script>
@endpush

