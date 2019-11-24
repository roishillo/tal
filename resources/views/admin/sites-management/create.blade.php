@extends('admin.layouts.portlet')

@section('portlet-content')

    @if(isset($site->id))

        @include('admin.partials.breadcrumbs', ['title' => 'Edit Site', 'data' => [ 'Site Management' => url('admin/sites'), 'Edit Site' => url('admin/sites/'.$site->id) ]])

    @else

        @include('admin.partials.breadcrumbs', ['title' => 'New Site', 'data' => [ 'Site Management' => url('admin/sites'), 'New Site' => url('admin/sites/create') ]])

    @endif

    <div class="m-content" style="padding-bottom: 0">
        <form  id="main-form" action="{{ isset($site->id) ? "/admin/sites/save/".$site->id : "/admin/sites/save/" }}" method="post">

            @csrf
            <div class="m-portlet__body">
                <div class="alert alert-danger" style="display: none">
                    <h4 class="block">
                        Attention
                    </h4>
                    <ul></ul>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-wrapper" style="margin-bottom: 0">

                <div class="m-content" style="padding-top: 10px; padding-bottom: 0">
                    <div class="row">
                        <div class="col-md-6">
                            <div>

                                <div class="m-portlet m-portlet--tab" >

                                    {{--subheader--}}

                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">Site Name</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                        <div class="form-group m-form__group m--margin-top-10">
                                            <div class="row" style="">
                                                <input type="text" class="form-control m-input col-md-12" placeholder="Enter Name" id="name" name="name" value ="{{ isset($site) ? $site->name : "" }}" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="container">
                                    <div class="row">
                                        <div class="m-portlet m-portlet--tab col-md-6">

                                            {{--subheader--}}

                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text"> Wifi Details</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                                <div class="form-group m-form__group m--margin-top-10">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-4 col-form-label" >Name:</label>  <div class="col-8"> <input type="text" class="form-control m-input"  id="wifi_name" name="wifi_name" value = "{{ isset($site) ? $site->wifi_name : "" }}" required></div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <label class="col-4 col-form-label" >Password:</label>  <div class="col-8"> <input type="text" class="form-control m-input"  id="wifi_password" name="wifi_password" value ="{{ isset($site) ? $site->wifi_password : "" }}"  required></div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="m-portlet m-portlet--tab col-md-6">

                                            {{--subheader--}}

                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">Site Address</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body ">
                                                <div class="form-group m-form__group m--margin-top-10">
                                                    <div class="row">
                                                        <input  type="text" class="form-control m-input col-md-12"  id="address" name="address" value="{{ isset($site) ? $site->address : "" }}"  required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--tab " style="min-height: 165px">

                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text"> Site Description</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                        <div class="form-group m-form__group m--margin-top-10">
                                            <textarea name="description" class="form-control m-input" id="description" rows="4" placeholder="Site Description"  required>{{ isset($site) ? $site->description : "" }}</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="m-portlet m-portlet--tab col-md-12 mr-auto">

                                    {{--subheader--}}

                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">Site Enabler Details</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                        <div class="form-group m-form__group m--margin-top-10">
                                            <div class="form-group m-form__group row">
                                                <label class="col-2 col-form-label" >Name:</label> <div class="col-10"><input type="text" class="form-control m-input" placeholder="Enabler Name" id="helper_name" name="helper_name" value="{{ isset($site) ? $site->helper_name : "" }}" required></div>
                                            </div>
                                            <div class="form-group m-form__group row" >
                                                <label class="col-2 col-form-label" >Phone:</label> <div class="col-10"><input type="text" class="form-control m-input" placeholder="Enabler Phone" id="helper_phone" name="helper_phone" value="{{ isset($site) ? $site->helper_phone : "" }}" required></div>
                                            </div>
                                            <div class="form-group m-form__group row" >
                                                <label class="col-2 col-form-label" >Whatsapp:</label> <div class="col-10"><input type="text" class="form-control m-input" placeholder="Enabler Whatsapp" id="helper_phone_whatsapp" name="helper_phone_whatsapp" value="{{ isset($site) ? $site->helper_phone_whatsapp : "" }}" required></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-2">

                            <div class="m-portlet m-portlet--tab ">

                                {{--subheader--}}

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">Upload Image</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__body" style="text-align: center; padding-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0">

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
                                                <img src="{{ isset($site) ? url('uploads/thumbnail/'.$site->visual_resource_path) : url('assets/admin/images/placeholder2.jpg')}}" class="image-input-placeholder">
                                                <input type="hidden" name="visual_resource_path" class="file-name-input" value="{{ isset($site)  ? $site->visual_resource_path : "" }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="m-portlet m-portlet--tab ">

                                {{--subheader--}}

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">Sound Byte</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__body" style="text-align:center; padding-top: 0; padding-bottom: 0;padding-left: 2%; padding-right: 2%">
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
                                                <img src="{{ isset($site) ? url('assets/admin/images/mp3.png') : url('assets/admin/images/mp3.png')}}" class="image-input-placeholder">
                                                <input type="hidden" name="audio_resource_path" class="file-name-input" value="{{ isset($site)  ? $site->audio_resource_path : "" }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-portlet m-portlet--tab " style="min-height: 236px;">

                                {{--subheader--}}

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">QR code</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__body" style="display:flex;flex-flow: column; align-items: center; padding-top: 13px; padding-bottom: 20px">
                                    @if( isset($site->barcode))
                                        <div class="form-group m-form__group m--margin-top-10" style="display:flex;flex-flow: row; justify-content: center">


                                            <img  id="barcode-image" src="data:image/png;base64,{{$site->barcode}}" alt="barcode"  />

                                        </div>
                                        <button type="button" id ="print-button" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air"><span><i class="fa fa-print"></i><span>Print</span></span></button>
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class = "row" style="display: flex; flex-flow: row; justify-content: center" >
                                <div class="col-6" style="padding-right: 0; display: flex" >
                                    <label class="col-form-label">Active Site</label>
                                    <div class="col-6">
                                        <div class="m-switch m-switch--icon m-switch--info">
                                            <label>
                                                <input type="checkbox" {{ isset($site) ? ($site->is_active ?  "checked" : "") : "checked" }} name="is_active" id="is_active">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" style="padding-left: 0;display: flex">
                                    <label class="col-form-label">Public Site</label>
                                    <div class="col-6">
                                        <div class="m-switch m-switch--icon m-switch--info">
                                            <label>
                                                <input type="checkbox" {{ isset($site) ? ($site->is_public ?  "checked" : "") : "checked" }} name="is_public" id="is_public">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet m-portlet--tab ">

                                <div class="container">

                                    <div class="row">

                                        <div class="m-portlet col-12" style="margin-bottom: 0">

                                            {{--subheader--}}

                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text"> No. of Stations</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group m--margin-top-10 row" >
                                                <div class="col-4"></div>

                                                <input class="col-5 form-control m-input" min="1" max ="99"
                                                       type="number"
                                                       name="predicted_stations"
                                                       id="predicted_stations"
                                                       placeholder="1 - 99"
                                                       value="{{ isset($site->predicted_stations) ? $site->predicted_stations  : "" }}"
                                                       required>
                                            </div>

                                        </div>
                                        <div class="m-portlet  col-6" style="margin-bottom: 0; display: none">

                                            {{--subheader--}}

                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">Accessibly level</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                                <div class="form-group m-form__group m--margin-top-10">
                                                    <div class="slidecontainer">
                                                        <input type="range" min="1" max="100" value="50" class="form-control m-input" id="myRange">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="m-portlet m-portlet--tab">

                                {{--subheader--}}

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">Web Site</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__body m-portlet__body--no-top-padding" style="padding-bottom: 1px">
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="row" style="">
                                            <input type="text" class="form-control m-input col-md-12" placeholder="Website or Facebook Page" id="web_link" name="web_link" value="{{ isset($site) ? $site->web_link : "" }}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div style="display:flex; flex-flow: row; justify-content: center; margin-top: 450px">
                                <a href="{{ "/admin/sites/" }}" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" style="margin-right: 10px;">
                            <span><i class="fa fa-arrow-left"></i><span>Back to Menu</span>
                            </span>
                                </a>
                                @if(!isset($site))
                                    <button class="btn btn-success m-btn--pill m-btn m-btn--custom m-btn--air m-btn--icon" style="margin-right: 10px;">
                            <span>
                                <span>Save</span>&nbsp;&nbsp;
                            </span>
                                    </button>
                                @elseif(isset($site) && ($user->id === $site->admin_id || $user->role === 'Admin'))
                                    <button class="btn btn-success m-btn--pill m-btn m-btn--custom m-btn--air m-btn--icon" style="margin-right: 10px;">
                            <span>
                                <span>Save</span>&nbsp;&nbsp;
                            </span>
                                    </button>
                                @endif
                                @if(isset($site))
                                    <button id="save-new-site" class="btn btn-success m-btn--pill m-btn m-btn--custom m-btn--air m-btn--icon">
                            <span>
                                <span>Save as New</span>&nbsp;&nbsp;
                            </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('freeScripts')

    <script>
        $(function() {
            $('#save-new-site').click(function () {
                $('#main-form').attr('action','/admin/sites/saveNew/')
            });

            $('#main-form').submit(function(event){
                event.preventDefault();
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success('Site saved Successfully', 'Success');
                        if(post_url === "/admin/sites/saveNew/") {
                            window.location.href = '/admin/sites/'+response+'/stations';
                        }
                        if(post_url === "/admin/sites/save/"){
                            window.location.href = '/admin/sites/'+response+'/stations';
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

            $('#print-button').click(function () {
                var barcode = $('#barcode-image').attr('src');
                PrintBarcode(barcode)
            });


            function PrintBarcode(elem)
            {

                var siteName = $('#name').val();
                var mywindow = window.open('', 'PRINT', 'height=600,width=800');

                mywindow.document.write('<html><head><title>QR code</title>');
                mywindow.document.write('</head><body >');
                mywindow.document.write('<h1>'+siteName+' QR code</h1>');
                mywindow.document.write(`<img style="width: 200px; height: 200px" src=${elem} />`);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                mywindow.close();

                return true;
            }

        });
    </script>
@endpush