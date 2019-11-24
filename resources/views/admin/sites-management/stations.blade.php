@extends('admin.layouts.portlet')

@section('portlet-content')

        @include('admin.partials.breadcrumbs', ['title' => 'Station Management', 'data' => [  'Site Management' => url('admin/sites'), 'Edit Site' => url('admin/sites/'.$siteId), 'Station Management' => url('admin/sites/'.$siteId.'/stations') ]])

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-content row">

            <div class="ui-sortable col-6" id="m_sortable_portlets">


            @foreach ($stations as $station)
                <div id = "item-{{$station->id}}-{{$station->order}}" class="m-portlet m-portlet--mobile m-portlet--sortable">

                    <div class="m-portlet__head ui-sortable-handle">
                        <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ isset($station) ? $station->name : "" }}
                        </h3>
                    </div>
                        </div>
                    </div>

                    <div class="m-portlet__body" >
                        <div class="m-widget5" style="display: flex; flex-flow: row">
                            <div class="m-widget5__item" style="width: inherit; display: flex; flex-flow: column; justify-content: center; margin-right: 10px;">
                                <span class="m-badge  m-badge--brand m-badge--wide station-order">#{{$station->order}}</span>
                            </div>
                            <div class="m-widget5__item">
                                <div class="m-widget5__content float-left">
                                    <div class="m-widget5__pic">
                                        <img src="{{ isset($station) ? url('uploads/thumbnail/'.$station->visual_resource_path) : url('assets/admin/images/placeholder2.jpg')}}" alt="">
                                    </div>
                                    <div class="m-widget5__section">
                                        <h4 class="m-widget5__title">
                                            {{ isset($station) ? $station->name : "" }}
                                        </h4>
                                        <span class="m-widget5__desc">
                                        {{ isset($station) ? $station->description : "" }}
                                    </span>
                                        <div class="m-widget5__info">
                                            ID: {{ isset($station) ? $station->id : "" }}

                                        </div>

                                    </div>
                                </div>
                                <div class="m-widget5__content float-left">
                                    <a href="/admin/sites/{{$siteId}}/stations/{{$station->id}}" class="btn btn-sm btn-outline-info" style=" margin-left: 10px;"><i class="fa fa-pen" style="padding-right: 5px;";></i>Edit</a>
                                </div>
                                <div class="m-widget5__content float-left">
                                    <button type="button" id="{{$station->id}}" name="{{$station->name}}" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1" style=" margin-left: 10px;"><i class="fa fa-times" style="padding-right: 5px;";></i>Delete</button>
                                </div>
                                <div class="m-widget5__content float-left m--margin-left-10">
                                    <a href="/admin/tasks/create/{{$station->id}}" class="btn btn-sm btn-info" >Add Task</a>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_modal_1_2_{{$station->id}}">See Station Tasks</button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                    @endforeach

                    @for($i = 1; $i <= $predictedNumOfStations-count($stations); $i++)
                        <div id = "item-{{$i}}-{{$i}}" class="" style="box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
    background-color: #ffffff;margin-bottom: 2.2rem;">

                            <div class="m-portlet__head" style="border-bottom: 1px solid #ebedf2;    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 0;
    padding: 0 2.2rem;
    height: 5.1rem;
    position: relative;">
                                <div class="m-portlet__head-caption" style="    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-line-pack: start;
    align-content: flex-start;">
                                    <div class="m-portlet__head-title" style="    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;">
                                        <h3 class="m-portlet__head-text" style="display: flex;
    -webkit-box-align: center;
    align-items: center;
    font-size: 1.3rem;
    font-weight: 500;
    font-family: Roboto;
    margin: 0;
    padding: 0;    color: #575962;">
                                            Predicted Station
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="m-portlet__body" style="color: #575962; padding: 2.2rem 2.2rem; ">
                                <div class="m-widget5" style="display: flex; flex-flow: row">
                                    <div class="m-widget5__item" style="width: inherit; display: flex; flex-flow: column; justify-content: center; margin-right: 10px;">
                                        {{--<span class="m-badge  m-badge--brand m-badge--wide station-order">#{{$i}}</span>--}}
                                    </div>
                                    <div class="m-widget5__item" style="margin-left: 35px">
                                        <div class="m-widget5__content float-left">
                                            <div class="m-widget5__pic">
                                                <img src="{{url('assets/admin/images/placeholder2.jpg')}}" alt="">
                                            </div>
                                            <div class="m-widget5__section">
                                                <h4 class="m-widget5__title">

                                                </h4>
                                                <span class="m-widget5__desc">
                                        {{--{{ isset($station) ? $station->description : "" }}--}}
                                    </span>
                                                <div class="m-widget5__info">
                                                    {{--ID: {{ isset($station) ? $station->id : "" }}--}}

                                                </div>

                                            </div>
                                        </div>
                                        <div class="m-widget5__content float-left">
                                            <a href="/admin/sites/{{$siteId}}/stations/{{count($stations)+1}}" class="btn btn-sm btn-outline-info" style=" margin-left: 10px;"><i class="fa fa-pen" style="padding-right: 5px;";></i>Edit</a>
                                        </div>
                                        <div class="m-widget5__content float-left">
                                            {{--<button type="button" id="{{count($stations)+1}}" name="" class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1" style=" margin-left: 10px;"><i class="fa fa-times" style="padding-right: 5px;";></i>Delete</button>--}}
                                        </div>
                                        <div class="m-widget5__content float-left m--margin-left-10">
                                            {{--<a href="/admin/tasks/create/{{count($stations)+1}}" class="btn btn-sm btn-info" >Add Task</a>--}}
                                            {{--<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_modal_1_2_{{count($stations)+1}}">See Station Tasks</button>--}}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    @endfor


            </div>
            <div class="m-portlet__head-tools col-5">

                <a href="/admin/sites/{{$siteId}}/stations/create/" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" style="margin-top: 3px">
						<span>
							<i class="la la-plus"></i>
							<span>New Station</span>
						</span>
                </a>

            </div>


        </div>
    @if(!$stations->isEmpty())
        @foreach ($stations as $station)

            <!--begin::Modal-->
                <div class="modal fade" id="m_modal_1_2_{{$station->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 1px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$station->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="300">
                                    @if(!$station->tasks->all()) <h3>No Tasks Set</h3> @endif
                                    @foreach($station->tasks as $task)

                                        <div class="m-widget5" style="display: flex; flex-flow: row">
                                            <div class="m-widget5__item" style="width: inherit; display: flex; flex-flow: column; justify-content: center; margin-right: 10px;">
                                                <span class="order-number">#{{$task->order}}</span>
                                            </div>
                                            <div class="m-widget5__item">
                                                <div class="m-widget5__content float-left">
                                                    <div class="m-widget5__pic">
                                                        <img src="{{url('uploads/thumbnail/'.$task->visual_resource_path)}}" alt="">
                                                    </div>
                                                    <div class="m-widget5__section">
                                                        <h4 class="m-widget5__title">
                                                            {{ $task->name }}
                                                        </h4>
                                                        <span class="m-widget5__desc">
                                                                {{ $task->description }}
                                                             </span>
                                                        <div class="m-widget5__info">
                                                            ID: {{ $task->id }}

                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

        @endforeach
        @else
        @for($i = 1; $i <= $predictedNumOfStations; $i++)

            <!--begin::Modal-->
                <div class="modal fade" id="m_modal_1_2_{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 1px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">predicted station {{$i}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="300">
                                    @if(isset($station))

                                    @if(!$station->tasks->all()) <h3>No Tasks Set</h3> @endif

                                    @foreach($station->tasks as $task)

                                        <div class="m-widget5" style="display: flex; flex-flow: row">
                                            <div class="m-widget5__item" style="width: inherit; display: flex; flex-flow: column; justify-content: center; margin-right: 10px;">
                                                <span class="order-number">#{{$task->order}}</span>
                                            </div>
                                            <div class="m-widget5__item">
                                                <div class="m-widget5__content float-left">
                                                    <div class="m-widget5__pic">
                                                        <img src="{{url('uploads/thumbnail/'.$task->visual_resource_path)}}" alt="">
                                                    </div>
                                                    <div class="m-widget5__section">
                                                        <h4 class="m-widget5__title">
                                                            {{ $task->name }}
                                                        </h4>
                                                        <span class="m-widget5__desc">
                                                                {{ $task->description }}
                                                             </span>
                                                        <div class="m-widget5__info">
                                                            ID: {{ $task->id }}

                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                        @endif

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

        @endfor
    @endif

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
            $('body').on('click','.delete', function () {
                var stationName = $(this).attr('name');
                var id = $(this).attr('id');
                $('#modalLabel').html(`Delete ${stationName}`);
                $('#modalDeleteButton').attr('href', `/admin/sites/{{$siteId}}/stations/${id}/delete`);
            } )
        });
    </script>
@endpush
