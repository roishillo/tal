@extends('admin.layouts.portlet')

@section('portlet-content')

    @if(isset($educand->id))
        @include('admin.partials.breadcrumbs', ['title' => 'Edit Hero', 'data' => [ 'Heroes Management' => url('admin/educands'), 'Edit Hero' => url('admin/educands/create/'.$educand->id) ]])
    @else
        @include('admin.partials.breadcrumbs', ['title' => 'New Hero', 'data' => [ 'Heroes Management' => url('admin/educands'), 'New Hero' => url('admin/educands/create') ]])
    @endif

    <div class="m-content">

        <div class="m-portlet">
            <form class="m-form m-form--fit m-form--label-align-right" id="main-form" action="{{ isset($educand->id) ? "/admin/educands/save/".$educand->id : "/admin/educands/save/" }}">
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
                                                <div class="col-7">

                                                    <div class="">
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-2 col-lg-2 col-form-label">* Full Name 1:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" id="full_name1" name="full_name1" class="form-control m-input" value="{{ isset($educand->full_name1)  ? $educand->full_name1 : "" }}" required>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row m--padding-bottom-15" >
                                                            <label class="col-xl-2 col-lg-2 col-form-label">* Full Name 2:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" id="full_name2" name="full_name2" class="form-control m-input" value="{{ isset($educand->full_name2)  ? $educand->full_name2 : "" }}" required >

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="educand-container " >
                                                        <div class="form-group m-form__group row m--padding-top-15"  id = "about_me-input">
                                                            <label class="col-xl-2 col-lg-2 col-form-label">About Me:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="input-group">

                                                                    <input type="text" name="about_me" class="form-control m-input" value="{{ isset($educand->about_me)  ? $educand->about_me : "" }}" >
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" id = "address-input">
                                                            <label class="col-xl-2 col-lg-2 col-form-label"  >* Address:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="input-group">
                                                                    <input type="text" name="address" class="form-control m-input" value="{{ isset($educand->address)  ? $educand->address : "" }}" required>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" id = "phone-input">
                                                            <label class="col-xl-2 col-lg-2 col-form-label"  >* Phone:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="input-group">
                                                                    <input type="text" name="phone" class="form-control m-input" value="{{ isset($educand->phone)  ? $educand->phone : "" }}" required>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" id = "disablity-input" style="display: none">
                                                            <label class="col-xl-2 col-lg-2 col-form-label" >Disability Level:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="input-group">
                                                                    <input type="text" name="disability" class="form-control m-input" >
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group m-form__group row" id ="gender-input">
                                                            <label class="col-xl-2 col-lg-2 col-form-label"  >* Gender</label>
                                                            <div class="col-xl-9 col-lg-9" style="padding-top: 10px">
                                                                {{--<div class="m-radio-list m--padding-left-15">--}}
                                                                <label class="m-radio" style="margin-right: 20px">
                                                                    <input type="radio" name="gender" value="m" {{ isset($educand)  ? ($educand->gender == 'm' ? "checked" : "" ) : "" }} required>Male
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio" name="gender" value="f"  {{ isset($educand)  ? ($educand->gender == 'f' ? "checked" : "" ) : "" }} >Female
                                                                    <span></span>
                                                                </label>

                                                                {{--</div>--}}
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-left: 0">
                                                            <div  class="col-6" style="margin-top: -20px">


                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-2 col-lg-2 col-form-label">* Educational Institute:</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" id="current-state" name="current_state" class="form-control m-input" value="{{ isset($educand)  ? $educand->current_state : "" }}" required>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-2 col-lg-2 col-form-label">* Birth Date</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" id="m_datepicker_4_1"  autocomplete="off" name="birth_date" class="form-control" value="{{ isset($educand)  ? \Carbon\Carbon::parse($educand->birth_date)->format('m/d/Y') : "" }}"  required placeholder="Select Date" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="educand-container col-5" style="margin-top: -40px; padding-left: 0;" >

                                                    <div class="m-form__section m-form__section--first" style="padding: 10px 50px; border: 2px solid #ebedf2; border-radius: 4px" id = "contact-input">
                                                        <div class="m-form__heading">
                                                            <h3 class="m-form__heading-title" align="center">Contact Person</h3>
                                                        </div>
                                                        <div class="form-group m-form__group row m-form__group--first" style="padding-left: 0; padding-right: 0">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">* First Name:</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="contact_first_name" class="form-control m-input" value="{{ isset($educand)  ? $educand->contact_first_name : "" }}"  required>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="padding-left: 0; padding-right: 0">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">* Last Name:</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="contact_last_name" class="form-control m-input" value="{{ isset($educand)  ? $educand->contact_last_name : "" }}" required>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="padding-left: 0; padding-right: 0">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">* Email:</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="email" name="contact_last_email" class="form-control m-input" value="{{ isset($educand)  ? $educand->contact_last_email : "" }}" required>

                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row m-form__group--last" style="padding-left: 0; padding-right: 0">
                                                            <label class="col-xl-4 col-lg-4 col-form-label">* Phone:</label>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <input type="text" name="contact_last_phone" class="form-control m-input" value="{{ isset($educand)  ? $educand->contact_last_phone : "" }}" required>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-form__section m-form__section--first" style="border: 2px solid #ebedf2; border-radius: 4px; display: flex; flex-flow: row; justify-content: center" id = "files">


                                                        <div class="form-group row">
                                                            <div>
                                                                <div class="m-form__heading" style="padding-left: 0">
                                                                    <h3 class="m-form__heading-title" align="center">* Hero Picture</h3>
                                                                </div>
                                                                <div class="fileinput" data-id="file-manager-educand" >
                                                                    <div class="fileinput-new thumbnail">
                                                                        <div class="options" >
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
                                                                        <img src="{{ isset($educand) ? url('uploads/thumbnail/'.$educand->visual_resource_path) : url('assets/admin/images/placeholder2.jpg')}}" class="image-input-placeholder">
                                                                        <input type="hidden" name="visual_resource_path" class="file-name-input" value="{{ isset($educand)  ? $educand->visual_resource_path : "" }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="m-form__heading" style="padding-left: 0; padding-right: 0">
                                                                    <h3 class="m-form__heading-title" align="center">* QR Scanning Instructions</h3>
                                                                </div>
                                                                <div class="fileinput" data-id="file-manager-qr-instructions" style="margin: 5px auto">
                                                                    <div class="fileinput-new thumbnail">
                                                                        <div class="options" >
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
                                                                        <img src="{{ isset($educand->qr_instructions_path) ? url('assets/admin/images/file-manager/filestypes/file.png') : url('assets/admin/images/file-manager/filestypes/file.png')}}" class="image-input-placeholder">
                                                                        <input type="hidden" name="qr_instructions_path" class="file-name-input" value="{{ isset($educand)  ? $educand->qr_instructions_path : "" }}" required>
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
												<span>Back to menu</span>
											</span>
                                </button>
                            </div>
                            <div class="col-lg-4 m--align-right">

                                <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                                </button>
                            </div>
                            <div class="col-lg-2"></div>
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
                        if(post_url === "/admin/educands/save/" ) {
                            $('#main-form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
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

        });
    </script>
@endpush