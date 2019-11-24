<?php

namespace App\Http\Controllers\Api;

use App\Models\EducandTaskTrack;
use App\Models\Entities\Educand;
use App\Models\Entities\Task;
use App\Services\Educand\EducandFacade;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EducandController extends BaseController
{

    public function show($educandId, Request $request)
    {
        $educand = EducandFacade::get($educandId, $request);

        if($educand) {

            return $this->success($educand);

        } else {

            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }
    }
    public function showAll(Request $request)
    {
        $educands = EducandFacade::getAll($request);

        if($educands || sizeof($educands) === 0) {

            return $this->success($educands);

        } else {

            return $this->error('LOGIN_ERRORS', 'UNKNOWN_ERROR');
        }
    }

    public function track(Educand $educand)
    {
        if($educand) {
            if(auth()->user()->role === "Admin" || $educand->admin_id === auth()->user()->id) {
                $track = EducandFacade::getTrackByEducandId($educand);

                if ($track) {

                    return $this->success(['track' => $track]);
                } else {

                    return $this->error('EDUCANDS_ERRORS', 'EDUCANT_WITHOUT_TRACK');
                }
            } else {
                return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
            }
        } else {

            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }
    }

    public function start(Educand $educand)
    {
        if($educand) {
            if(auth()->user()->role === "Admin" || $educand->admin_id === auth()->user()->id) {
                $start = EducandFacade::startTrack($educand);
                if ($start) {

                    return $this->success(['Success' => true]);
                } else {

                    return $this->error('EDUCANDS_ERRORS', 'EDUCANT_WITHOUT_TRACK');
                }
            } else {
                return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
            }
        } else {

            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }
    }

    public function finish(Educand $educand, Request $request)
    {
        if($educand) {
            if(auth()->user()->role === "Admin" || $educand->admin_id === auth()->user()->id) {
                $track = EducandFacade::endTrack($educand, $request);
                if (!($track instanceof \Exception) && $track) {

                    return $this->success(['Success' => true]);
                } else {

                    return $this->error('EDUCANDS_ERRORS', 'EDUCANT_WITHOUT_TRACK');
                }
            } else {
                return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
            }
        } else {

            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }
    }
    public function help(Educand $educand, Task $task)
    {
        if($educand) {
            if(auth()->user()->role === "Admin" || $educand->admin_id === auth()->user()->id) {
                $track = EducandFacade::askForHelp($educand, $task);
                if ($track) {

                    return $this->success(['Success' => true]);
                } else {

                    return $this->error('EDUCANDS_ERRORS', 'EDUCANT_WITHOUT_TRACK');
                }
            } else {
                return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
            }
        } else {

            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }
    }

    public function zipfiles(Educand $educand)
    {
        if($educand) {
            if(auth()->user()->role === "Admin" || $educand->admin_id === auth()->user()->id) {
                EducandFacade::zipfiles($educand);
                return response()->download($educand->id . '.zip')->deleteFileAfterSend();
            } else {
                return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
            }
        } else {
            return $this->error('EDUCANDS_ERRORS', 'INVALID_EDUCAND_ID');
        }

    }
}
