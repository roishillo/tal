@extends('admin.layouts.portlet')

@section('portlet-content')
    @include('admin.partials.breadcrumbs', ['title' => 'User Management', 'data' => [ 'User Management' => url('admin/admins') ]])

    <div class="m-content" style="padding-bottom: 0">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head" style="min-height: 70px">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Users Table
                    </h3>
                </div>
            </div>
            @if(isset($user) && $user->role != 'Site Builder')
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="/admin/admins/create" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>New User</span>
						</span>
                        </a>
                    </li>
                </ul>
            </div>
                @endif
        </div>
    <div class="m-portlet__body">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12">
       <!-- User Table -->
                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid" aria-describedby="admins-table_info" id="admins-table">
                    <thead>
                    <tr role="row">
                        <th>{{__('ID')}}</th>
                        <th>{{__('First Name')}}</th>
                        <th>{{__('Last Name')}}</th>
                        <th>{{__('Login Email')}}</th>
                        <th>{{__('Role')}}</th>
                        <th>{{__('Management')}}</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>


                <!-- / User Table -->
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('pageButtons')
    {{--<a class="btn btn-danger"><i class="fa fa-edit"></i>{{ __('Button 1')}}</a>--}}
@endsection


@push('freeScripts')

<script>
    $(function() {
        $('#admins-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('admin.admins-management.get-data') !!}',
            language : {},
            dom : "<'pull-right margin-bottom-20'f> <'table-scrollable'tr><'row'<'records col-md-4'l><'info col-md-4'i><'page col-md-4'p>>",
            columns: [
                { data: 'id', name: 'id', inputType: 'int', searchable: true },
                { data: 'first_name', name: 'first_name', inputType: 'text', searchable: true },
                { data: 'last_name', name: 'last_name', inputType: 'text', searchable: true },
                { data: 'email', name: 'email', inputType: 'text', searchable: true },
                { data: 'role', name: 'role', inputType: 'text', searchable: true, render: function (datafield) {
                    let spanClass;
                    switch(datafield){
                        case 'Admin':
                            spanClass = "m-badge m-badge--brand m-badge--wide";
                            break;
                        case 'Site Builder':
                            spanClass = "m-badge m-badge--success m-badge--wide";
                            break;
                        case 'Helper':
                            spanClass = "m-badge m-badge--info m-badge--wide";
                            break;
                    }
                        return `<span class ="${spanClass}" >${datafield}</span>`;
                    } },
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
    });
</script>


@endpush