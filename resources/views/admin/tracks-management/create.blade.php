@extends('admin.layouts.portlet')

@section('portlet-content')
    @include('admin.partials.breadcrumbs', ['title' => 'New Route', 'data' => [ 'Routes' => url('admin/tracks'), 'New Route' => url('admin/tracks/create')]])
    <div class="m-content" style="margin-top: 2px">
        <div class="m-portlet">
            <form  class="m-form m-form--fit m-form--label-align-right" id="main-form" method="post" action="/admin/tracks/save/">
                <div class="m-portlet__body">
                    <div class="alert alert-danger" style="display: none">
                        <h4 class="block">
                            Attention
                        </h4>
                        <ul></ul>
                    </div>
                </div>
                <div class="m-wizard__form" id="wizard" >

                    @csrf
                    <div class="m-portlet__body" >
                        <div class="m-wizard__form-step m-wizard__form-step--current name" id="m_wizard_form_step_1" >
                            <div class="row">
                                <div class="col-xl-11 offset-xl-1">
                                    <div class="m-form__section m-form__section--first">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">* Route Name:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" id="name" name="name" class="form-control m-input" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer" style="display: none">
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

                                        <tr class="data-row">
                                            <td class="task-order" style="max-width: 50px">
                                                <input name="order[]" class ="form-control m-input col-12" type=number value=1></input>
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


                                                </select>
                                            </td>
                                            <td class="task-name">
                                                <select class="form-control m-bootstrap-select m_selectpicker taskSelector" name="task_id[]" data-size="5">
                                                    <option  disabled selected value>select a task</option>
                                                </select>

                                            </td>
                                            <td class="management"></td>
                                        </tr>

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
                        <div class="col-lg-4 m--align-right m--margin-top-10" style="float: right; display: none">
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
                                    <button onclick="location.href='/admin/tracks'" type="button" id="cancel-button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>&nbsp;&nbsp;
												<span>Back to Menu</span>
											</span>
                                    </button>
                                    <button type="button" id="back-button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev" style="display: none">
											<span>
												<i class="la la-arrow-left"></i>&nbsp;&nbsp;
												<span>Back</span>
											</span>
                                    </button>
                                </div>
                                <div class="col-lg-4 m--align-right">
                                    <button type="button" class="btn btn-success m-btn m-btn--custom m-btn--icon" id="next-button">
											<span>
												<span>Next</span>&nbsp;&nbsp;
                                                <i class="la la-arrow-right"></i>&nbsp;
											</span>
                                    </button>
                                    <button type="submit" class="btn btn-success m-btn m-btn--custom m-btn--icon" id="save-button" style="display: none">
											<span>
												<span>Save</span>&nbsp;&nbsp;
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
            $('.station-name').children().hide();
            $('.task-name').children().hide();

            $('#next-button').click(function () {
                if ($('#name')[0].checkValidity()) {
                    $('.alert-danger').hide();
                    $('.name').hide();
                    $('#cancel-button').hide();
                    $('#back-button').show();
                    $('#next-button').hide();
                    $('#save-button').show();
                    $('.dataTables_wrapper').show();
                    $('#new-row').parent().show();
                } else {
                    $('.alert-danger').show();
                    $(".alert-danger").find("ul").append('<li>Name must be filled in</li>');
                }
            });
            $('#back-button').click(function () {
                $('#back-button').hide();
                $('#cancel-button').show();
                $('#save-button').hide();
                $('#next-button').show()
                $('.name').show();
                $('.dataTables_wrapper').hide();
            });

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
                <select class="form-control m-bootstrap-select m_selectpicker siteSelector" name="site_id[]">
                             <option  disabled selected value>select a site</option>
                                   @foreach($sites as $site)
                    <option class ="select-options" value="{{$site->id}}">{{$site->name}}</option>
                                   @endforeach
                    </select>
                </td>
                <td class="station-name">
                <select class="form-control m-bootstrap-select m_selectpicker stationSelector"  name="station_id[]">
                </select></td>
                <td class="task-name">
                <select class="form-control m-bootstrap-select m_selectpicker taskSelector" name="task_id[]">
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
                        if(post_url === "/admin/tasks/save/" ) {
                            $('#main-form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
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
                $(".alert-danger").show();
                $.each(msg, function (key, value) {
                    $(".alert-danger").find("ul").append('<li>' + value + '</li>');
                });
            }

        });
    </script>
@endpush