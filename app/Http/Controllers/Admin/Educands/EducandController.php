<?php

namespace App\Http\Controllers\Admin\Educands;

use App\Http\Controllers\Controller;
use App\Models\Entities\Educand;
use App\Services\Educand\EducandFacade;
use App\Services\Track\TrackFacade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EducandController extends Controller
{
    public function index()
    {
        return view('admin.educands-management.index');
    }
    public function getEducandsTableQuery()
    {
        return DataTables::of(EducandFacade::getEducands())
            ->editColumn('admin_id', function (Educand $educand){
                return $educand->admin->email;
            })
            ->addColumn('management', function (Educand $educand){

                return '
                        <button type="button"  class="btn btn-sm btn-outline-danger delete" data-toggle="modal" data-target="#m_modal_1" ><i class="fa fa-times" style="padding-right: 5px";></i>Delete</button>
                        <a href="/admin/educands/create/'.$educand->id.'" class="btn btn-sm btn-outline-info"><i class="fa fa-pen" style="padding-right: 5px";></i>Edit</a>';

            })
//
            ->rawColumns(['management'])
            ->make(true);
    }

    public function create($educandId = null)
    {
        if($educandId) {
            $educand = EducandFacade::getById($educandId);
        }
        return view('admin.educands-management.create', compact('educand'));
    }
    public function save(Request $request, $educandId = null)
    {
        $request['birth_date'] = Carbon::parse($request->birth_date);
        $validatedData = EducandFacade::validateEducandRequest($request);

        $saved = EducandFacade::save($validatedData, $educandId);

        if($saved){
            return 'Educand Saved Successfully';
        }
    }
    public function delete($educandId)
    {
        $deleted = EducandFacade::delete($educandId);

        if($deleted){

            return back();
        }
    }
}