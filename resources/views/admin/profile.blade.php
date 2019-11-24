@extends('admin.layouts.app')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">My Profile</h3>
            </div>

        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">

            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#tab_info" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        {{trans('admin.profile.titles.personal_info')}}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_password" role="tab">
                                        {{trans('admin.profile.titles.change_password')}}
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-portlet__nav-item--last"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_info">
                            {{ Form::open(['url' => url('admin/profile/update'), 'class' => 'm-form m-form--fit m-form--label-align-right' ]) }}
                            <div class="alert alert-danger" style="display: none">
                                <h4 class="block">
                                    Attention
                                </h4>
                                <ul></ul>
                            </div>
                                <div class="m-portlet__body">

                                    {{  Form::model($user) }}
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">First Name</label>
                                        <div class="col-7">
                                            {{ Form::bsText('first_name') }}
                                            {{--<input class="form-control m-input" type="text" value="Mark Andre">--}}
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Last Name</label>
                                        <div class="col-7">
                                            {{ Form::bsText('last_name') }}
                                            {{--<input class="form-control m-input" type="text" value="CTO">--}}
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Email</label>
                                        <div class="col-7">
                                            {{ Form::bsText('email') }}
                                            {{--<input class="form-control m-input" type="text" value="Keenthemes">--}}
                                        </div>
                                    </div>


                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane" id="tab_password">
                            {{ Form::open(['url' => url('admin/profile/change-password'), 'id' => 'password-form', 'class' => 'm-form m-form--fit m-form--label-align-right' ]) }}
                                <div class="m-portlet__body">
                                    <div class="alert alert-danger" style="display: none">
                                        <h4 class="block">
                                            Attention
                                        </h4>
                                        <ul></ul>
                                    </div>
                                    {{ Form::bsPassword('current_password', trans('admin.profile.forms.change_password.current_password')) }}
                                    {{ Form::bsPassword('new_password', trans('admin.profile.forms.change_password.new_password')) }}
                                    {{ Form::bsPassword('new_password_confirmation',  trans('admin.profile.forms.change_password.new_password_confirmation')) }}

                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                                    {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>		        </div>
</div>


</div>
<!-- end:: Body -->

@endsection

@push('freeScripts')

    <script>
        $(function() {

            $('form').submit(function(event){
                event.preventDefault();
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                that = this;
                console.log(form_data);
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                        $('form').find(" input[type=password],  textarea").val("");
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