@extends('admin.layouts.portlet')

@section('portlet-content')

    @if(isset($station->id))

        @include('admin.partials.breadcrumbs', ['title' => 'Edit Station', 'data' => [ 'Station Management' => url('admin/sites'), 'Edit Station' => url('admin/sites/'.$siteId.'/stations/'.$station->id) ]])

    @else

        @include('admin.partials.breadcrumbs', ['title' => 'New Station', 'data' => [ 'Station Management' => url('admin/sites'), 'New Station' => url('admin/sites/'.$siteId.'/stations/create') ]])

    @endif

    <form  action="{{ isset($station->id) ? "/admin/sites/".$siteId."/stations/save/".$station->id : "/admin/sites/".$siteId."/stations/save" }}" method="post">
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif

        @csrf
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <div class="m-content">


                <div class="m-portlet m-portlet--tab">


                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row ">

                            <div class="col-4">
                                <div class="form-group m-form__group" style="display: flex">
                                <label class="col-form-label m--margin-right-10" >Name:</label>  <input type="text" class="form-control m-input" placeholder= "Station Name" id="name" name="name" value = "{{ isset($station) ? $station->name : "" }}" required>
                                </div>
                                <div class="form-group m-form__group row " style="flex-flow: row">

                                    <div class="" style="display: inline-block; margin-left: 80px;">
                                        <div class="fileinput" data-id="file-manager-5c052deaafd1d">
                                            <div class="fileinput-new thumbnail">
                                                <div class="options">
                                                    <ul>
                                                        <li class="remove-red tooltips remove-image" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="remove">
                                                            <i class="fa fa-times"></i>
                                                        </li>
                                                        <li id="modal-popup-filemanager" class="tooltips open-file" data-toggle="tooltip" title="" data-file={{url('assets/admin/images/placeholder2.jpg')}} data-placement="bottom" data-original-title="open">
                                                            <i class="fa fa-external-link-alt" aria-hidden="true"></i>
                                                        </li>
                                                        <li class="tooltips select-file" data-toggle="tooltip" title="" data-placement="bottom" data-ismulti="&quot;false&quot;" data-filetype="&quot;image&quot;" data-newminfiles="&quot;1&quot;" data-newmaxfiles="&quot;1&quot;" data-allowed-extensions="" data-original-title="choose">
                                                            <i class="fa fa-cloud" aria-hidden="true"></i>
                                                        </li>
                                                        <li class="tooltips upload-file" data-toggle="tooltip" title="" data-placement="bottom" data-ismulti="&quot;false&quot;" data-filetype="&quot;image&quot;" data-newminfiles="&quot;1&quot;" data-newmaxfiles="&quot;1&quot;" data-allowed-extensions="" data-original-title="upload">
                                                            <i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="img-container"></div>
                                                <img src="{{ isset($station) ? url('uploads/thumbnail/'.$station->visual_resource_path) : url('assets/admin/images/placeholder2.jpg')}}" class="image-input-placeholder">
                                                <input type="hidden" name="visual_resource_path" class="file-name-input" value="{{ isset($station)  ? $station->visual_resource_path : "" }}" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group m-form__group row ">
                                <label class=" col-form-label m--margin-right-10" >Description:</label>  <input type="text" class="col-xl-9 col-lg-9 form-control m-input" placeholder= "description" id="description" name="description" value ="{{ isset($station) ? $station->description : "" }}"  required>
                                </div>
                                <div style="display: flex; flex-flow: row; margin-left: 10px">
                                    <label class="col-form-label m--margin-right-10" >Active Station</label>
                                    <div class="col-5" style="padding-left: 0">
                                        <div class="m-switch m-switch--icon m-switch--info">
                                            <label>
                                                <input type="checkbox" {{ isset($station) ? ($station->is_active ?  "checked" : "") : "checked" }} name="is_active" id="is_active">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; flex-flow: row; margin-left: 10px">
                                    <label class="col-form-label m--margin-right-10">Public Station</label>
                                    <div class="col-5" style="padding-left: 0">
                                        <div class="m-switch m-switch--icon m-switch--info">
                                            <label>
                                                <input type="checkbox" {{ isset($station) ? ($station->is_public ?  "checked" : "") : "checked" }} name="is_public" id="is_public">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!(isset($station)))
                            <div class="col-4">
                                <div class="form-group m-form__group row ">
                                    <div class="col-lg-12 m-form__group-sub row">
                                        <label class="col-form-label col-7">Preceding Station:</label>
                                        <select class="form-control m-bootstrap-select m_selectpicker col-5" id="preceding" name="preceding">
                                            <option value="">None</option>
                                            @foreach($stations as $item)

                                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                @endif
                        </div>

                    </div>

                </div>
                <div class="col-12" style="display: flex; flex-flow: row; justify-content: flex-end" >
                    <a href="{{ "/admin/sites/".$siteId."/stations/" }}" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" style="margin-right: 5px;"><span><i class="fa fa-arrow-left"></i><span>Back to Menu</span></span></a>
                    <button  type="submit" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" style="margin-right: 5px">Save</button>
                    @if(isset($station->id))
                    <button  id="save-new-station" class="btn btn-success m-btn--pill m-btn m-btn--custom m-btn--air m-btn--icon">
                            <span>
                                <span>Save as New</span>&nbsp;&nbsp;
                            </span>
                    </button>
                        @endif
                </div>
            </div>
        </div>
    </form>
@endsection

@push('freeScripts')

    <script>
        $('#save-new-station').click(function (e) {

            $('form').attr('action',"/admin/sites/{{$siteId}}/stations/saveNew/");
        });

        </script>

    @endpush