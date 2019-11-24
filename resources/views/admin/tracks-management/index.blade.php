@extends('admin.layouts.portlet')

@section('portlet-content')

    @include('admin.partials.breadcrumbs', ['title' => 'Routes', 'data' => [ 'Routes' => url('admin/tracks')]])

    <div class="m-content">
    <div class="m-portlet m-portlet--mobile">

        <div class="m-portlet__head" style="min-height: 70px">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Routes
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="/admin/tracks/create" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span>New Routes</span>
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
                        <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid"  id="tracks-table">
                            <thead>
                            <tr role="row">
                                <th>{{__('ID')}}</th>
                                <th>{{__('Route Title')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Last Changed')}}</th>
                                <th>{{__('Public Route?')}}</th>
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
        </div>
        <!--begin::Modal-->
        <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 1px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/admin/tracks/assign">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Assign Heroes </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <select multiple="multiple" id="educands" name="educands[]">
                            @foreach($educands as $educand )
                                <option track="{{$educand->track_id}}" value={{$educand->id}}>{{$educand->full_name1}} {{$educand->full_name2}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-primary" id="modalSaveButton">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Modal-->
        <!--begin::Modal-->
        <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 1px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelDelete">Delete </h5>
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
                    $('body').on('click','.delete', function () {
                        var name = ($(this).attr('name'));
                        var id = ($(this).attr('id'));
                        $('#modalLabelDelete').html(`Delete ${name}`);
                        $('#modalDeleteButton').attr('href', `/admin/tracks/${id}/delete`);
                    } )

                    $('#educands').multiSelect();

                    $(document).on('click', '.assign', function () {

                        var currentTrackId = $(this).parent().siblings('.id').html();
                        $('#m_modal_1').find('form').attr('action',`/admin/tracks/${currentTrackId}/assign` );
                        var options = $('#m_modal_1').find('option');
                        for(i=0;i<options.length; i++){
                            if($(options[i]).attr('track') === currentTrackId){
                                $(options[i]).attr('selected', 'selected')

                            } else {
                                $(options[i]).removeAttr('selected')

                            }
                        }

                        $('#educands').multiSelect('refresh');
                    });

                    $('#tracks-table').DataTable({
                        processing: false,
                        serverSide: true,
                        ajax: '{!! route('admin.tracks-management.get-data') !!}',
                        language : {},
                        dom : "<'pull-right margin-bottom-20'f> <'table-scrollable'tr><'row'<'records col-md-4'l><'info col-md-4'i><'page col-md-4'p>>",
                        columns: [
                            { data: 'id', name: 'id', inputType: 'int', searchable: true, className: 'id' },
                            { data: 'name', name: 'name', inputType: 'text', searchable: true },
                            { data: 'created_at', name: 'created_at', inputType: 'int', searchable: true },
                            { data: 'updated_at', name: 'updated_at', inputType: 'int', searchable: true },
                            { data: 'is_public', name: 'is_public', inputType: 'int', searchable: true, render: function (dataField) {
                                    if(dataField) {
                                        return '<label class="m-checkbox"><input class="is_public" type="checkbox" checked><span></span></label>'
                                    } else {
                                        return '<label class="m-checkbox"><input class="is_public" type="checkbox"><span></span></label>'
                                    }
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

                                //== Class definition

                                var BootstrapSelect = function () {

                                    //== Private functions
                                    var demos = function () {
                                        // minimum setup
                                        $('.m_selectpicker').selectpicker();
                                    };

                                    return {
                                        // public functions
                                        init: function() {
                                            demos();
                                        }
                                    };
                                }();

                                jQuery(document).ready(function() {
                                    BootstrapSelect.init();
                                });

                                $('form').submit(function(event){
                                    event.preventDefault();
                                    let post_url = $(this).attr("action");
                                    let form_data = $(this).serialize();
                                    $.post(post_url, form_data, function(){})
                                        .done(function(response){
                                            window.location.href = "{{URL::to('admin/tracks?')}}"

                                        })
                                        .fail(function (response) {
                                            if(response.status == 422){
                                                printErrorMsg(response.responseJSON.errors);
                                            }
                                            else {
                                                toastr.error(response.statusText, 'Error');
                                            }
                                        })
                            })

                            });
                        }

                    });
                    $(document).on( 'click', '.is_public', function(){
                        const clicked = this;
                       var $id = $(clicked).parent().parent().siblings('.sorting_1').html();


                            $(".alert-danger").find("ul").html('');
                            $(".alert-danger").hide();
                            $.post("/admin/tracks/set-public", { id: $id } ,function(){})
                                .done(function(response){

                                    toastr.success(response, 'Success');
                                    if(post_url === "/admin/tasks/save/" ) {
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