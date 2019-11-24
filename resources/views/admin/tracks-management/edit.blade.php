@extends('admin.layouts.portlet')

@section('portlet-content')
    @include('admin.partials.breadcrumbs', ['title' => 'Edit Route', 'data' => [ 'Routes' => url('admin/tracks'), 'Edit Route' => url('admin/tracks/'.$track->id)]])
    <div class="m-content" style="margin-top: 2px">
        <form  class="m-form m-form--fit m-form--label-align-right" id="main-form" method="post" action="/admin/tracks/save/{{$track->id}}">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <div class="form-group m-form__group row" style="padding-bottom: 0">
                                <label for="" class="col-2 col-form-label">Name:</label>
                                <div class="col-10">
                                    <input type="text" name="name" class="form-control m-input" value="{{$track->name}}">
                                </div>
                            </div>
                            <div  style="display: flex; margin-top: 10px">
                                <label class="col-form-label">Public Site</label>
                                <div class="col-6">
                                    <div class="m-switch m-switch--icon m-switch--info">
                                        <label>
                                            <input type="checkbox" {{ isset($track) ? ($track->is_public ?  "checked" : "") : "checked" }} name="is_public" id="is_public">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body" style="display: none">
                    <div class="alert alert-danger" >
                        <h4 class="block">
                            Attention
                        </h4>
                        <ul></ul>
                    </div>
                </div>
                <div class="m-wizard__form" id="wizard" >

                    @csrf
                    <div class="m-portlet__body" >

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">

                                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" role="grid"  id="tasks-table">
                                        <thead>
                                        <tr role="row">
                                            <th>{{__('Order')}}</th>
                                            <th>{{__('Site Name')}}</th>
                                            <th>{{__('Station Name')}}</th>
                                            <th>{{__('Task Name')}}</th>
                                            <th>{{__('Management')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($track->tasks as $task)
                                            <tr class="data-row">
                                                <td class="task-order" style="max-width: 50px">
                                                    <input name="order[]" class ="form-control m-input col-12" type=number value="{{$task->pivot->order}}"></input>
                                                </td>
                                                <td class="site-name">

                                                    <select class="form-control m-bootstrap-select m_selectpicker siteSelector" name="site_id[]" data-size="5">
                                                        <option  disabled selected value>select a site</option>
                                                        @foreach($sites as $item)
                                                            <option class ="select-options" value="{{$item->id}}" @if($item->id == $task->station->site->id) selected @endif >{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="station-name">

                                                    <select class="form-control m-bootstrap-select m_selectpicker stationSelector" name="station_id[]" data-size="5">
                                                        <option  disabled selected value>select a station</option>
                                                        @foreach($sites as $site)
                                                            @if($site->id === $task->station->site->id)
                                                                @foreach($site->stations as $station)
                                                                    <option class ="select-options" value="{{$station->id}}" @if($station->id == $task->station->id) selected @endif >{{$station->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach


                                                    </select>
                                                </td>
                                                <td class="task-name">
                                                    <select class="form-control m-bootstrap-select m_selectpicker taskSelector" name="task_id[]" data-size="5">
                                                        <option  disabled selected value>select a task</option>
                                                        @foreach($tasks as $item)
                                                            <option class ="select-options" value="{{$item->id}}" @if($item->id == $task->id) selected @endif >{{$item->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </td>
                                                <td class="management"><button type="button" class="btn btn-sm btn-outline-danger delete-button"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                                                    <a href="/admin/tasks/{{$task->id}}" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 m--align-right m--margin-top-10" style="float: right">
                            <button type="button" class="btn btn-success m-btn m-btn--custom m-btn--icon" id="new-row">
											<span>
                                                <i class="la la-plus"></i>
												<span>New Row</span>&nbsp;&nbsp;
                                                &nbsp;
											</span>
                            </button>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4 m--align-left">
                                    <button  onclick="location.href='/admin/{{ explode('/admin/',URL::previous())[1] }}'" type="button" id="back-button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>&nbsp;&nbsp;
												<span>Back to Menu</span>
											</span>
                                    </button>
                                </div>
                                <div class="col-lg-3 m--align-right">
                                    @if(!isset($track))
                                        <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                                        </button>
                                    @elseif(isset($track) && ($user->id === $track->admin_id || $user->role === 'Admin'))
                                        <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button">
											<span>
												<span>Save</span>&nbsp;&nbsp;

											</span>
                                        </button>
                                    @endif
                                </div>

                                <div class="col-lg-2 ">
                                    <button class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-new-track">
											<span>
												<span>Save as New</span>&nbsp;&nbsp;

											</span>
                                    </button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    </div>
@endsection

@push('freeScripts')

    <script>
        $(function() {

            $('body').on('change','.siteSelector',function () {
                var id = $(this).val();
                var select = $(this);

                $.post("/admin/sites/getStations", {id}, function () {
                })
                    .done(function (stationsArray) {
                        select.parent().parent().siblings('.station-name').children().show();

                        select.parent().parent().siblings('.station-name').find('select').html('').append(`<option  disabled selected value>select a station</option>`);
                        stationsArray.forEach(function (station) {

                            select.parent().parent().siblings('.station-name').find('select').append(`<option class ="select-options" value="${station.id}">${station.name}</option>`);

                        });
                        $('.stationSelector').selectpicker('refresh')

                    });
            });
            $('body').on('change','.stationSelector',function () {
                var id = $(this).val();
                var select = $(this);

                $.post("/admin/tasks/getStationTasks", {id}, function () {
                })
                    .done(function (tasksArray) {

                        select.parent().parent().siblings('.task-name').children().show();
                        select.parent().parent().siblings('.task-name').find('select').html('').append(`<option  disabled selected value>select a task</option>`);
                        tasksArray.forEach(function (task) {

                            select.parent().parent().siblings('.task-name').find('select').append(`<option class ="select-options" value="${task.id}">${task.name}</option>`);

                        });
                        $('.taskSelector').selectpicker('refresh')

                    });
            });

            $('body').on('change','select.taskSelector',function () {
                var id = $(this).val();
                var select = $(this);

                select.parent().parent().siblings('.management').html(`<button type="button" class="btn btn-sm btn-outline-danger delete-button"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                                                                     <a href="/admin/tasks/${id}" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>`);
                select.parent().siblings('.management').html(`<button type="button" class="btn btn-sm btn-outline-danger delete-button"><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                                                                     <a href="/admin/tasks/${id}" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>`);

            });



            $('#new-row').click(function () {

                //== Class definition

                var BootstrapSelect = function () {

                    //== Private functions
                    var demos = function () {
                        // minimum setup
                        $('.m_selectpicker').selectpicker();
                        $("tr").eq(-2).find('.station-name, .task-name').children().hide();
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

                var last = $('.task-order').find('input').last().val();
                if(last) {
                    var count = JSON.parse(last);
                } else {
                    var count = 0;
                }
                count++;
                var newRow = `<tr class="data-row-${count}">
                <td class="task-order" style="max-width: 50px">
                <input name="order[]" class ="form-control m-input col-12" type=number value=${count}></input>
                </td>
                <td class="site-name">
                <select class="form-control m-bootstrap-select m_selectpicker siteSelector" name="site_id[]" data-size="5">
                             <option  disabled selected value>select a site</option>
                                   @foreach($sites as $site)
                    <option class ="select-options" value="{{$site->id}}">{{$site->name}}</option>
                                   @endforeach
                    </select>
                </td>
                <td class="station-name">
                <select class="form-control m-bootstrap-select m_selectpicker stationSelector"  name="station_id[]" data-size="5">
                </select></td>
                <td class="task-name">
                <select class="form-control m-bootstrap-select m_selectpicker taskSelector" name="task_id[]" data-size="5">
                    <option  disabled selected value>select a task</option>
                </select>
                </td>
                <td class="management"></td>
                        </tr>`;
                var optionsText = [];
                var optionsValue = [];
                var selectOptions = $('.select-options').not('.dropdown-item');
                Array.prototype.forEach.call(selectOptions, function (item) {
                    optionsText.push(item.innerHTML);
                    optionsValue.push(item.value);
                });

                $('tbody').append(newRow);

            });


            $('body').on('click','.delete-button',function () {
                var index = $(this).parent().siblings('.task-order').find('input').val();
                var toReorder = $(`.task-order:gt(${index-1})`).find('input');

                Array.prototype.forEach.call(toReorder, function (item) {
                    $(item).val($(item).val() - 1);
                });
                $(this).parent().parent().remove();
            });

            $('#save-new-track').click(function () {
                $('#main-form').attr('action','/admin/tracks/saveNew/')
            });

            $('#main-form').submit(function(event){
                event.preventDefault();

                var orderInputs = $('input[name="order[]"]');
                orderValues =  jQuery.map(orderInputs, function (orderInput) {
                    return JSON.parse($(orderInput).val());
                });


                var sorted_arr = orderValues.slice().sort();

                var results = [];
                for (var i = 0; i < sorted_arr.length - 1; i++) {
                    if (sorted_arr[i + 1] == sorted_arr[i]) {
                        results.push(sorted_arr[i]);
                    }
                }
                if(results.length){
                    $(".alert-danger").show();
                    $(".alert-danger").find("ul").append('<li>Order must be unique</li>');
                    printErrorMsg('Order must be unique')
                }

                $(".alert-danger").find("ul").html('');
                $(".alert-danger").hide();
                let post_url = $(this).attr("action");
                let form_data = $(this).serialize();
                $.post(post_url, form_data, function(){})
                    .done(function(response){
                        toastr.success(response, 'Success');
                        if(post_url === "/admin/tracks/saveNew/") {
                            window.location.href = "{{URL::to('admin/tracks')}}"
                        }

                    })
                    .fail(function (response) {
                        if(response.status == 422){
                            printErrorMsg(response.responseJSON.errors);
                        }
                        else {
                            toastr.error(response.responseText, 'Error');
                        }
                    })

            });

            function printErrorMsg(msg) {
                $(".alert-danger").parent().show();
                $.each(msg, function (key, value) {
                    $(".alert-danger").find("ul").append('<li>' + value + '</li>');
                });
            }

        });
    </script>
@endpush