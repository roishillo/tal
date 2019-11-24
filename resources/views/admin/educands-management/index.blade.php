@extends('admin.layouts.portlet')

@section('portlet-content')

    @include('admin.partials.breadcrumbs', ['title' => 'Heroes Management', 'data' => [ 'Heroes Management' => url('admin/educands')]])

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">

            <div class="m-portlet__head" style="min-height: 70px">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Heroes Table
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="/admin/educands/create" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>New Hero</span>
						</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="m-portlet__body">
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
                                    <th>{{__('Enabler')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Phone')}}</th>
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

@section('pageButtons')
    {{--<a class="btn btn-danger"><i class="fa fa-edit"></i>{{ __('Button 1')}}</a>--}}
@endsection


@push('freeScripts')

            <script>
                $(function() {
                    $('#educands-table').DataTable({
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
                            { data: 'admin_id', name: 'admin_id', inputType: 'text', searchable: true, className: "admin_id" },
                            { data: 'address', name: 'address', inputType: 'text', searchable: true },
                            { data: 'phone', name: 'phone', inputType: 'text', searchable: true },
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
                });
            </script>
@endpush