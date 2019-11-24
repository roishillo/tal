@extends('admin.layouts.portlet')

@section('portlet-content')
    <div class="m-portlet">
        <form class="m-form m-form--fit m-form--label-align-right" id="main-form" action="/admin/admins/{{$admin->id}}/reset">

            <div class="m-wizard__form" id="wizard" >
                <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" >

                    @csrf
                    <div class="m-portlet__body" >
                        <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                            <div class="row">
                                <div class="col-xl-8 offset-xl-1">
                                    <div class="m-form__section m-form__section--first">

                                        <div class="row">
                                            <div class="col-9">

                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">Password:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="password" id="password" name="password" class="form-control m-input" >

                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">Confirm Password:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control m-input" >

                                                    </div>
                                                </div>
                                                <div class="alert alert-danger" style="display: none">
                                                    <h4 class="block">
                                                        Attention
                                                    </h4>
                                                    <ul></ul>
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
												<span>Back</span>
											</span>
                                    </button>
                                </div>
                                <div class="col-lg-4 m--align-right">

                                    <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Reset Password</span>&nbsp;&nbsp;
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
                // console.log(form_data);
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                    })
                    .fail(function (response) {
                        if(response.status == 422){
                            printErrorMsg(response.responseJSON.errors);
                        }
                        else {
                            console.log(response)
                            toastr.error(response.statusText, 'Error');
                        }
                    })

            });

            function printErrorMsg (msg) {
                console.log(msg.password);
                $(".alert-danger").show();
                $.each( msg.password, function( key, value ) {
                    $(".alert-danger").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>
@endpush