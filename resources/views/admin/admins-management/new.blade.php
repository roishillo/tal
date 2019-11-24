@extends('admin.layouts.portlet')

@section('portlet-content')

    @include('admin.partials.breadcrumbs', ['title' => 'New User', 'data' => [ 'User Management' => url('admin/admins'), 'New User' => url('admin/admins/create') ]])
    <div class="m-content">

<div class="m-portlet">
    <form class="m-form m-form--fit m-form--label-align-right" id="main-form" action="/admin/admins/save/">
        <div class="m-portlet__body">
            <div class="alert alert-danger" style="display: none">
                <h4 class="block">
                    Attention
                </h4>
                <ul></ul>
            </div>
            <div class="form-group m-form__group row" >
                <label class="col-form-label col-lg-3 col-sm-12">User Type:</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <select class="form-control m-bootstrap-select m_selectpicker" id="select-type" name="role">
                      @if(isset($user) && $user->role === 'Admin')  <option>Admin</option> @endif
                          @if(isset($user) && $user->role === 'Admin')  <option>Site Builder</option> @endif
                        <option>Enabler</option>
                    </select>
                </div>
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
                                                <label class="col-xl-2 col-lg-2 col-form-label">* First Name:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <input type="text" id="first_name" name="first_name" class="form-control m-input" required>

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label class="col-xl-2 col-lg-2 col-form-label">* Last Name:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <input type="text" id="last_name" name="last_name" class="form-control m-input" required >

                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row m--padding-bottom-15"  id="email-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label">* Email:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <input type="email" id="email" name="email" class="form-control m-input" required autocomplete="off">

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row m--padding-bottom-15"  id="password-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label">* Password:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <input type="password" id="password" name="password" class="form-control m-input" required autocomplete="off">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="site-builder-container" @if(isset($user) && $user->role === 'Admin') style="display: none" @endif>
                                            <div class="form-group m-form__group row m--padding-top-15" id = "phone_1-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label">* Phone 1:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                        <input type="text" name="phone" class="form-control m-input" >
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row"  id = "phone_2-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label"  >Phone 2:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                        <input type="text" name="phone_2" class="form-control m-input">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" id = "organization-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label">School/ Organization/ Company:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <input type="text" name="organization" class="form-control m-input" >

                                                </div>
                                            </div>
                                        </div>

                                        <div class="educand-container " style="display: none">
                                            <div class="form-group m-form__group row m--padding-top-15"  id = "about_me-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label">About Me:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <div class="input-group">

                                                        <input type="text" name="about_me" class="form-control m-input" >
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" id = "address-input">
                                                <label class="col-xl-2 col-lg-2 col-form-label"  >Address:</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <div class="input-group">
                                                        <input type="text" name="address" class="form-control m-input" >
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="educand-container col-4" style="margin-top: -40px; padding-left: 0;display: none" >

                                            <div class="m-form__section m-form__section--first" style="padding-left: 0" id = "contact-input">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title" align="center">Contact Person</h3>
                                                </div>
                                                <div class="form-group m-form__group row m-form__group--first" style="padding-left: 0; padding-right: 0">
                                                <label class="col-xl-4 col-lg-4 col-form-label">First Name:</label>
                                                <div class="col-xl-8 col-lg-8">
                                                    <input type="text" name="contact_first_name" class="form-control m-input" >

                                                </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-left: 0; padding-right: 0">
                                                    <label class="col-xl-4 col-lg-4 col-form-label">Last Name:</label>
                                                    <div class="col-xl-8 col-lg-8">
                                                        <input type="text" name="contact_last_name" class="form-control m-input" >

                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-left: 0; padding-right: 0">
                                                    <label class="col-xl-4 col-lg-4 col-form-label">Email:</label>
                                                    <div class="col-xl-8 col-lg-8">
                                                        <input type="email" name="contact_last_email" class="form-control m-input" >

                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row m-form__group--last" style="padding-left: 0; padding-right: 0">
                                                    <label class="col-xl-4 col-lg-4 col-form-label">Phone:</label>
                                                    <div class="col-xl-8 col-lg-8">
                                                        <input type="text" name="contact_last_phone" class="form-control m-input">

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
                            <button onclick="location.href='/admin/admins'" type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>&nbsp;&nbsp;
												<span>Back to Menu</span>
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
        let selector = $('#select-type');
            selector.change(function(event){
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                switch (selector.val()) {
                    case 'Admin':
                        $(".admin-container").show();
                        $(".site-builder-container").hide().find("*").removeAttr('required');
                        $(".educand-container").hide().find("*").removeAttr('required');
                        $('#email-input').show().find("input").attr('required', 'required');

                        break;
                    case 'Site Builder':
                        $(".admin-container").show();
                        $(".site-builder-container").show().find("input[name=phone]").attr('required', 'required');
                        $(".educand-container").hide().find("*").removeAttr('required');
                        $('#email-input').show().find("input").attr('required', 'required');

                        break;
                    case 'Helper':
                        $(".admin-container").show();
                        $(".site-builder-container").show().find("input[name=phone]").attr('required', 'required');
                        $(".educand-container").hide().find("*").removeAttr('required');
                        $('#email-input').show().find("input").attr('required', 'required');

                        break;
                    case 'Educand':
                        $(".admin-container").show();
                        $(".site-builder-container").hide().find("*").removeAttr('required');
                        $(".educand-container").show().find( "input[name^='contact']").attr('required', 'required');
                        $('#email-input').hide().find("*").removeAttr('required');

                        break;
                }
            });
            $('#main-form').submit(function(event){
                event.preventDefault();
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                if($('#select-type').val() === 'Enabler'){
                    form_data = form_data.replace('role=Enabler','role=Helper');
                    console.log(form_data);
                }
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                        $('#main-form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
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