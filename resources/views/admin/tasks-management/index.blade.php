@extends('admin.layouts.portlet')

@section('portlet-content')
    @include('admin.partials.breadcrumbs', ['title' => 'Task Management', 'data' => [ 'Task Management' => url('admin/tasks') ]])
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head" style="min-height: 70px">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Task Table
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="/admin/tasks/create/" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>New Task</span>
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
                            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid"  id="tasks-table">
                                <thead>
                                <tr role="row">
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Task Title')}}</th>
                                    <th>{{__('Task Description')}}</th>
                                    <th>{{__('Site Name')}}</th>
                                    <th>{{__('Station Name')}}</th>
                                    <th>{{__('Visual Aid')}}</th>
                                    <th>{{__('Audio Aid')}}</th>
                                    <th>{{__('Public Task')}}</th>
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

                    $('body').on('click','.delete', function () {
                        var name = ($(this).attr('name'));
                        var id = ($(this).attr('id'));
                        $('#modalLabel').html(`Delete ${name}`);
                        $('#modalDeleteButton').attr('href', `/admin/tasks/${id}/delete`);
                    } )


                    $('#tasks-table').DataTable({
                        processing: false,
                        serverSide: true,
                        ajax: '{!! route('admin.tasks-management.get-data') !!}',
                        language : {},
                        dom : "<'pull-right margin-bottom-20'f> <'table-scrollable'tr><'row'<'records col-md-4'l><'info col-md-4'i><'page col-md-4'p>>",
                        columns: [
                            { data: 'id', name: 'id', inputType: 'int', searchable: true },
                            { data: 'name', name: 'name', inputType: 'text', searchable: true },
                            { data: 'description', name: 'description', inputType: 'text', searchable: true },
                            { data: 'station.site.name', name: 'site', inputType: 'text', searchable: true },
                            { data: 'station.name', name: 'station', inputType: 'text', searchable: true },
                            { data: 'visual_resource_path', name: 'visual_aid', inputType: 'text',orderable: false, render: function (dataField) { return `<img src='/uploads/thumbnail/${dataField}' />`; } },
                            { data: 'audio_resource_path', name: 'audio_aid', inputType: 'text', searchable: false, render: function (dataField) { return `<audio controls style="max-width: 220px;"><source src='/uploads/original/${dataField}' ></audio>`; } },
                            { data: 'is_public', name: 'is_public', inputType: 'text', searchable: true, render: function (dataField) {
                                    if(dataField) {
                                        return '<span class="m-badge  m-badge--info m-badge--wide">yes</span>'
                                    } else {
                                        return '<span class="m-badge  m-badge--info m-badge--wide">no</span>';
                                    }
                                } },
                            { data: 'management', name: 'management', orderable: false }
                            // {
                            //     data: 'is_active', orderable: false, render: function (dataField) {
                            //
                            //         var editSite = "/admin/sites/" + dataField[1];
                            //         var siteStations ="/admin/sites/" + dataField[1] + "/stations";
                            //         //console.log(str);
                            //         if (dataField[0]) {
                            //             return `<a href="" class="btn btn-sm btn-outline-primary"><i class="fa fa-toggle-on" style="padding-right: 5px";></i>Active</a>
                            //
                            //         <a href=${editSite} class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                            //
                            //         <a href=${siteStations} class="btn btn-sm btn-outline-success"><i class="fa fa-sign" style="padding-right: 5px";></i>Stations</a>`;
                            //         }
                            //         else {
                            //             return `<a href="" class="btn btn-sm btn-outline-primary"><i class="fa fa-toggle-off" style="padding-right: 5px";></i>Inactive</a>
                            //
                            //         <a href=${editSite} class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>
                            //
                            //         <a href=${siteStations} class="btn btn-sm btn-outline-success"><i class="fa fa-sign" style="padding-right: 5px";></i>Stations</a>`;
                            //         }
                            //     }
                            // }
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