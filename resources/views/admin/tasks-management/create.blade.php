@extends('admin.layouts.portlet')

@section('portlet-content')

    @if(isset($task->id))

        @include('admin.partials.breadcrumbs', ['title' => 'Edit Task', 'data' => [ 'Task Management' => url('admin/tasks'), 'Edit Task' => url('admin/tasks/'.$task->id) ]])

    @else

        @include('admin.partials.breadcrumbs', ['title' => 'New Task', 'data' => [ 'Task Management' => url('admin/tasks'), 'New Task' => url('admin/tasks/create') ]])

    @endif

    <div class="m-content">

    <div class="m-portlet">
    <form  class="m-form m-form--fit m-form--label-align-right" id="main-form" action="{{ isset($task->id) ? "/admin/tasks/save/".$task->id : "/admin/tasks/save/" }}" method="post">
        <div class="m-portlet__body">
            <div class="alert alert-danger" style="display: none">
                <h4 class="block">
                    Attention
                </h4>
                <ul></ul>
            </div>
        </div>
        <div class="m-wizard__form" id="wizard" >
            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" >
                @csrf
                <div class="m-portlet__body" >
                    <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                        <div class="row">
                            <div class="col-xl-11 offset-xl-1">
                                <div class="m-form__section m-form__section--first">

                                    <div class="row">
                                        <div class="col-8">

                                            <div class="admin-container">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">* Task Name:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" id="name" name="name" class="form-control m-input" value="{{ isset($task) ? $task->name : "" }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">* Description:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <textarea id="description" name="description" class="form-control m-input" required >{{ isset($task) ? $task->description : "" }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row m--padding-bottom-15"  id="">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">Site:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control m-bootstrap-select m_selectpicker" id="select-site" name="site_id">

                                                            @if(isset($sites))

                                                                @foreach($sites as $site)

                                                                    <option value="{{$site->id}}" @if(isset($task)) {{ $site->id == $task->station->site_id ? "selected = selected" : ""}} @endif @if(isset($station)) {{$site->id ==  $station->site_id  ? "selected = selected" : ""}} @endif >{{$site->name}} </option>

                                                                @endforeach

                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row m--padding-bottom-15"  id="">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">Station:</label>
                                                    <div class="col-xl-9 col-lg-9" id="station-select-container">
                                                        <select class="form-control m-bootstrap-select m_selectpicker" id="select-station" name="station_id">

                                                            @if(isset($sites))
                                                                @if(!isset($task))
                                                                    @if((!isset($station)))
                                                                        @if($sites->has('0'))
                                                                            @foreach($sites[0]->stations as $item)

                                                                                <option value="{{$item->id}}" @if(isset($task)) {{$item->id == $task->station_id  ? "selected = selected" : ""}} @endif @if(isset($station)) {{$item->id ==  $station->id  ? "selected = selected" : ""}} @endif >{{$item->name}} </option>

                                                                            @endforeach
                                                                        @endif
                                                                    @else

                                                                        @foreach($stations as $item)

                                                                            <option value="{{$item->id}}" @if(isset($task)) {{$item->id == $task->station_id  ? "selected = selected" : ""}} @endif @if(isset($station)) {{$item->id ==  $station->id  ? "selected = selected" : ""}} @endif >{{$item->name}} </option>

                                                                        @endforeach

                                                                    @endif
                                                                @else
                                                                    @foreach($stations as $item)

                                                                        <option value="{{$item->id}}" @if(isset($task)) {{$item->id == $task->station_id  ? "selected = selected" : ""}} @endif @if(isset($station)) {{$item->id ==  $station->id  ? "selected = selected" : ""}} @endif >{{$item->name}} </option>

                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="educand-container col-4" style="margin-top: -40px; padding-left: 0;" >

                                            <div class="m-form__section m-form__section--first" style="padding-left: 0" id = "contact-input">
                                                <div style="border: 2px solid #ebedf2; border-radius: 4px; padding: 10px 0 0 0; margin-bottom: 10px">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title" align="center">Files</h3>
                                                </div>
                                                <div class="form-group m-form__group row m-form__group--first" style="padding-left: 0; padding-right: 0">
                                                    <label class="col-xl-4 col-lg-4 col-form-label">Visual Aid:</label>
                                                    <div class="col-xl-8 col-lg-8">
                                                        <div class="" style="display: inline-block;">
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
                                                                    <img src="{{ isset($task) ? url('uploads/thumbnail/'.$task->visual_resource_path) : url('assets/admin/images/placeholder2.jpg')}}" class="image-input-placeholder">
                                                                    <input type="hidden" name="visual_resource_path" class="file-name-input" value="{{ isset($task)  ? $task->visual_resource_path : "" }}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-left: 0; padding-right: 0">
                                                    <label class="col-xl-4 col-lg-4 col-form-label">Sound Byte:</label>
                                                    <div class="col-xl-8 col-lg-8">
                                                        <div class="m--margin-bottom-15" style="display: inline-block;">
                                                            <div class="fileinput" data-id="file-manager-5c052deaafd1x">
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
                                                                    <img src="{{ isset($task) ? url('assets/admin/images/mp3.png') : url('assets/admin/images/mp3.png')}}" class="image-input-placeholder">
                                                                    <input type="hidden" name="audio_resource_path" class="file-name-input" value="{{ isset($task)  ? $task->audio_resource_path : "" }}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                </div>
                                                <div style="padding-left: 0;display: flex">
                                                    <label class="col-form-label m--padding-left-15">Public Task</label>
                                                    <div class="col-6">
                                                        <div class="m-switch m-switch--icon m-switch--info">
                                                            <label>
                                                                <input type="checkbox" {{ isset($task) ? ($task->is_public ?  "checked" : "") : "checked" }} name="is_public" id="is_public">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 m--align-left">
                                <button onclick="location.href='/admin{{ explode('/admin',URL::previous())[1] }}'" type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>&nbsp;&nbsp;
												<span>Back to Menu</span>
											</span>
                                </button>
                            </div>
                            <div class="col-lg-3 m--align-right">
                                @if(!isset($task))
                                <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                                </button>
                                    @elseif(isset($task) && ($user->id === $task->admin_id || $user->role === 'Admin'))
                                    <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                                    </button>
                                @endif
                            </div>
                            @if(isset($task))
                            <div class="col-lg-2 ">
                                <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-new-task">
											<span>
												<span>Save as New</span>&nbsp;&nbsp;

											</span>
                                </button>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </form>
    </div>
    </div>
@endsection

@push('freeScripts')

    <script>
        $(function() {
            $('#save-new-task').click(function () {
                $('#main-form').attr('action','/admin/tasks/saveNew/')
            });

            $('#main-form').submit(function(event){
                event.preventDefault();
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                console.log(form_data);
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                        if(post_url === "/admin/tasks/save/" ) {
                            $('#main-form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
                        }
                        if(post_url === "/admin/tasks/saveNew/") {
                            window.location.href = "{{URL::to('admin/tasks')}}"
                        }
                    })
                    .fail(function (response) {
                        if(response.status == 422){
                            printErrorMsg(response.responseJSON.errors);
                        }
                        else {
                            console.log(response);
                            toastr.error(response.statusText, 'Error');
                        }
                    })

            });

            function printErrorMsg (msg) {
                $(".alert-danger").show();
                $.each( msg, function( key, value ) {
                    $(".alert-danger").find("ul").append('<li>'+value+'</li>');
                });
            }
            var sites ={!! json_encode($sites->toArray(), JSON_HEX_TAG) !!};
            $(document).on('change','#select-site', function () {
               var currentSiteId = ($('#select-site')).val();
                $('#station-select-container').html('');
                sites.forEach(function (site) {
                    if(site.id == currentSiteId) {
                        var stations = site.stations;
                        if (stations.length != 0) {
                            $('#station-select-container').html(`<select class="form-control m-bootstrap-select m_selectpicker" id="select-station" name="station_id"></select>`);
                            stations.forEach(function (station) {
                                $('#select-station').append(`<option value="${station.id}" >${station.name}</option>`);
                            });
                            BootstrapSelect.init();
                        }
                        else{
                            $('#station-select-container').html('site has no stations');
                        }
                    }
                })
            });

        });
        </script>
    @endpush