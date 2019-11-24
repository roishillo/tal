@extends('admin.layouts.portlet')

@section('portlet-content')

    @include('admin.partials.breadcrumbs', ['title' => 'Edit User', 'data' => [ 'User Management' => url('admin/admins'), 'Edit User' => url('admin/admins/'.$admin->id) ]])
    <div class="m-content">

    <div class="m-portlet">

    <div class="m-wizard__form">
    <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" action="{{ isset($admin->id) ? "/admin/admins/save/".$admin->id : "/admin/admins/save/" }}">
        <div class="alert alert-danger" style="display: none">
            <h4 class="block">
                Attention
            </h4>
            <ul></ul>
        </div>
    @if(isset($admin->id)) <input type="hidden" name ="id" value="{{$admin->id}}"> @endif
        @csrf
        <input type="hidden" name="role" value="{{isset($admin) ? $admin->role : "" }}">
    <div class="m-portlet__body">
        <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="m-form__section m-form__section--first">

                        <div class="row">
                            <div class="col-9">
                                @if(isset($admin) && ($admin->role == 'Admin' || $admin->role == 'Site Builder' || $admin->role == 'Helper' || $admin->role == 'Educand'))
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-2 col-lg-2 col-form-label">* First Name:</label>
                                        <div class="col-xl-7 col-lg-7">
                                            <input type="text" id="first_name" name="first_name" class="form-control m-input" placeholder="First Name" value="{{ isset($admin) ? $admin->first_name : "" }}">

                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-2 col-lg-2 col-form-label">* Last Name:</label>
                                        <div class="col-xl-7 col-lg-7">
                                            <input type="text" id="last_name" name="last_name" class="form-control m-input" placeholder="Last Name" value="{{ isset($admin) ? $admin->last_name : "" }}">

                                        </div>
                                    </div>
                                    @if($admin->role != 'Educand')
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Email:</label>
                                            <div class="col-xl-7 col-lg-7">
                                                <input type="email" id="email" name="email" class="form-control m-input" placeholder="Email" value="{{ isset($admin) ? $admin->email : "" }}">

                                            </div>
                                        </div>
                                    @endif
                                @endif
                                    @if(isset($admin) && ($admin->role == 'Site Builder' || $admin->role == 'Helper'))
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Phone 1:</label>
                                            <div class="col-xl-7 col-lg-7">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" name="phone" class="form-control m-input" placeholder="" value="{{ isset($admin) ? $admin->phone : "" }}">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">Phone 2:</label>
                                            <div class="col-xl-7 col-lg-7">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" name="second_phone" class="form-control m-input" placeholder="" value="{{ isset($admin) ? $admin->second_phone : "" }}">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">School/ Organization/ Company:</label>
                                            <div class="col-xl-7 col-lg-7">
                                                <input type="text" name="organization" class="form-control m-input" placeholder="" value="{{ isset($admin) ? $admin->organization : "" }}">

                                            </div>
                                        </div>
                                    @endif

                            </div>
                            <div class="m-section">
                                @if(isset($admin) && (($admin->role === 'Site Builder' || $admin->role === 'Admin') && $admin->sites->all()))

                                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- User Table -->
                                                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid"  id="sites-table">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>{{__('ID')}}</th>
                                                        <th>{{__('Image')}}</th>
                                                        <th>{{__('Name')}}</th>
                                                        <th>{{__('Description')}}</th>
                                                        <th>{{__('Address')}}</th>
                                                        <th>{{__('Website/Facebook Page')}}</th>
                                                        <th>{{__('Enabler Name')}}</th>
                                                        <th>{{__('Enabler Phone Number')}}</th>
                                                        <th>{{__('Management')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr>
                                                    </tfoot>
                                                </table>

                                                <!-- / User Table -->
                                            </div>
                                        </div>
                                    </div>

                                @elseif(isset($admin) && (($admin->role === 'Helper' || $admin->role === 'Admin') && $admin->educands->all()))

                                    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- User Table -->
                                                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid"  id="educands-table">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>{{__('ID')}}</th>
                                                        <th>{{__('Image')}}</th>
                                                        <th>{{__('Full Name 1')}}</th>
                                                        <th>{{__('Full Name 2')}}</th>
                                                        <th>{{__('Address')}}</th>
                                                        <th>{{__('Management')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>


                                                <!-- / User Table -->
                                            </div>
                                        </div>
                                    </div>

                                @endif
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

                        <button  class="btn btn-success m-btn m-btn--custom m-btn--icon">
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
        <!--begin::Modal-->
        <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 1px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Delete </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="" class="btn btn-primary" id="modalDeleteButton">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
    </div>
@endsection

@push('freeScripts')

    <script>
        $(function() {

            $('#educands-table').DataTable({

                scrollCollapse: true,
                processing: false,
                serverSide: true,
                ajax: '{!! route('admin.educands-management.get-data') !!}',
                language : {},
                dom : "<'pull-right margin-bottom-20'f> <'table-scrollable'tr><'row'<'records col-md-4'l><'info col-md-4'i><'page col-md-4'p>>",
                columns: [
                    { data: 'id', name: 'id', inputType: 'int', searchable: true, className: "id" },
                    { data: 'visual_resource_path', name: 'image', inputType: 'int', orderable: false, render: function (dataField) { return `<img src='/uploads/thumbnail/${dataField}' />`; } },
                    { data: 'full_name1', name: 'full_name1', inputType: 'text', searchable: true, className: "first_name" },
                    { data: 'full_name2', name: 'full_name2', inputType: 'text', searchable: true, className: "last_name" },
                    { data: 'address', name: 'address', inputType: 'text', searchable: true },
                    { data: 'management', name: 'management', orderable: false }

                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var columnIndex = column[0];
                        var columnData =  column.init().aoColumns[columnIndex];

                        switch (columnData.inputType) {
                            case 'text':
                                var input = $(document.createElement('input')).addClass('form-control');
                                break;
                            case 'select':
                                var input = $(document.createElement('select')).addClass('form-control');
                                for (var item of columnData.inputOptions) {
                                    input.append( '<option value="'+item.value+'">'+item.label+'</option>' )
                                }
                                break;
                            default:
                        }

                        if (!input) {
                            return;
                        }
                        $(input).appendTo($(column.footer()).empty())
                            .on('input change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        // $('.dataTables_paginate').removeClass().addClass('dataTables_paginate paging_simple_numbers');
                    });
                }

            });
            $('body').on('click','.delete', function () {
                var firstName = ($(this).parent().siblings('.first_name').html());
                var lastName = ($(this).parent().siblings('.last_name').html());
                var id = ($(this).parent().siblings('.id').html());
                $('#modalLabel').html(`Delete ${firstName} ${lastName}`);
                $('#modalDeleteButton').attr('href', `/admin/educands/${id}/delete`);
            } )

            $('#sites-table').DataTable({

                scrollCollapse: true,
                processing: false,
                serverSide: true,
                ajax: '{!! route('admin.sites-management.get-data') !!}',
                language : {},
                dom : "<'pull-right margin-bottom-20'f> <'table-scrollable'tr><'row'<'records col-md-4'l><'info col-md-4'i><'page col-md-4'p>>",
                columns: [
                    { data: 'id', name: 'id', inputType: 'int', searchable: true },
                    { data: 'visual_resource_path', name: 'image', inputType: 'int', orderable: false, render: function (dataField) { return `<img src='/uploads/thumbnail/${dataField}' />`; } },
                    { data: 'name', name: 'name', inputType: 'text', searchable: true },
                    { data: 'description', name: 'description', inputType: 'text', searchable: true },
                    { data: 'address', name: 'address', inputType: 'text', searchable: true },
                    { data: 'web_link', name: 'web_link', inputType: 'text', searchable: true },
                    { data: 'helper_name', name: 'helper_name', inputType: 'text', searchable: true },
                    { data: 'helper_phone', name: 'helper_phone', inputType: 'text', searchable: true },
                    { data: 'is_active', orderable: false }
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var columnIndex = column[0];
                        var columnData =  column.init().aoColumns[columnIndex];

                        switch (columnData.inputType) {
                            case 'text':
                                var input = $(document.createElement('input')).addClass('form-control');
                                break;
                            case 'select':
                                var input = $(document.createElement('select')).addClass('form-control');
                                for (var item of columnData.inputOptions) {
                                    input.append( '<option value="'+item.value+'">'+item.label+'</option>' )
                                }
                                break;
                            default:
                        }

                        if (!input) {
                            return;
                        }
                        $(input).appendTo($(column.footer()).empty())
                            .on('input change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });

                    });
                }
            });



            $(' form ').submit(function(event){
                event.preventDefault();
                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                    })
                    .fail(function (response) {
                        if(response.status == 422){
                            printErrorMsg(response.responseJSON.errors);
                        }
                        else {
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

