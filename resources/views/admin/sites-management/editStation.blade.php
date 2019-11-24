@extends('admin.layouts.portlet')

@section('portlet-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">Stations</h3>
                </div>
                <div class="">
                    <a href="" class="btn btn-info m-btn m-btn--icon "><span><i class="fa fa-plus"></i><span>New Station</span></span></a>
                </div>
            </div>
        </div>
        <div class="m-content">
            <ul>
                @foreach ($stations as $station)
                    <div class="m-portlet m-portlet--tab">



                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row ">
                                <span  class="col-form-label col-1">Station ID: {{$station->id}}</span>
                                <label class=" col-form-label" >Name:</label>  <div class="col-3"> <input type="text" class="form-control m-input" placeholder= "Station Name" id="wifi_name" name="wifi_name" value = "{{ isset($station) ? $station->name : "" }}" ></div>


                                <label class=" col-form-label" >Description:</label>  <div class="col-5"> <input type="text" class="form-control m-input" placeholder= "description" id="description" name="description" value ="{{ isset($station) ? $station->description : "" }}"  ></div>
                            </div>
                            <div class="form-group m-form__group row ">
                                <img src="{{url('assets/admin/images/product6.jpg')}}" style="height: 80px; width: 100px; margin-right: 10px" alt="">
                                <div style="display: flex; flex-flow: column; justify-content: space-between; height: 80px">
                                    <button class="btn btn-sm btn-info">Choose Image</button>
                                    <button class="btn btn-sm btn-info">Upload Image</button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
