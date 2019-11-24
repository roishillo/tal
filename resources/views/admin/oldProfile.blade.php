@extends('admin.layouts.app')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title">{{trans('admin.profile.titles.profile')}}</h3>

                    <ul class="m-subheader__breadcrumbs nav nav-tabs  m-tabs-line">
                        <li class=" nav-item m-tabs__item">
                            <a href="#tab_info" class="nav-link m-tabs__link @if($activeTab == 'info') active @endif" data-toggle="tab"> {{trans('admin.profile.titles.personal_info')}} </a>
                        </li>
                        <li class=" m-nav__item">
                            <a href="#tab_password" class="nav-link m-tabs__link @if($activeTab == 'password') active @endif" data-toggle="tab"> {{trans('admin.profile.titles.change_password')}} </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<div class="m-content">
    <div class="portlet-body">
        <div class="tab-content">

            <div id="tab_info" class="tab-pane @if($activeTab == 'info') active @endif">
                {{ Form::open(['url' => url('admin/profile/update')]) }}
                <div class="alert alert-danger" style="display: none">
                    <h4 class="block">
                        Attention
                    </h4>
                    <ul></ul>
                </div>
                <div class="row">
                    {{  Form::model($user) }}
                    <div class="col-lg-6">
                        {{ Form::bsText('first_name') }}
                        {{ Form::bsText('last_name') }}
                        {{ Form::bsText('email') }}
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="form-actions" style="text-align: center; margin-left: 15px;">
                        <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <div id="tab_password" class="tab-pane @if($activeTab == 'password') active @endif">
                {{ Form::open(['url' => url('admin/profile/change-password'), 'id' => 'password-form']) }}
                <div class="alert alert-danger" style="display: none">
                    <h4 class="block">
                        Attention
                    </h4>
                    <ul></ul>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                            {{ Form::bsPassword('current_password', trans('admin.profile.forms.change_password.current_password')) }}
                            {{ Form::bsPassword('new_password', trans('admin.profile.forms.change_password.new_password')) }}
                            {{ Form::bsPassword('new_password_confirmation',  trans('admin.profile.forms.change_password.new_password_confirmation')) }}
                    </div>
                </div>
                <hr/>

                <div class="row">
                    <div class="form-actions" style="text-align: center; margin-left: 15px;">
                        <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>
    </div>
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
                        $('form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
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