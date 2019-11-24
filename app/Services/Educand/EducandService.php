<?php

namespace App\Services\Educand;

use App\Models\EducandTaskTrack;
use App\Models\Entities\Educand;
use App\Models\Entities\Task;
use App\Models\Transformers\EducandTransformerForId;
use App\Models\Transformers\SiteTransformer;
use App\Models\Transformers\StationTransformer;
use App\Models\Transformers\TaskTransformer;
use App\Models\Transformers\TrackTransformer;
use App\Repositories\Educand\EducandInterface;

use App\Services\Admin\AdminFacade;
use Carbon\Carbon;

use Compie\Micropay\Exceptions\SendException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Zip;
use Compie\Micropay\Options\Send;
use Compie\Micropay\Facade\Micropay;


class EducandService
{
    protected $educandRepo;

    public static $messageText = 'Hero needs help!';


    public function __construct(EducandInterface $educandRepo)
    {
        $this->educandRepo = $educandRepo;
    }

    public function getById($educandId)
    {
        return $this->educandRepo->getById($educandId);
    }

    public function get($educandId, $request)
    {
        try {
            if (auth()->user()) {
                $educand = $this->educandRepo->get(auth()->user(), $educandId);
            }
            if ($educand) {
                $transformedEducand = EducandTransformerForId::transform($educand, $request);

                return $transformedEducand;
            }
        } catch (\Exception $exception) {

            return null;
        }
    }

    public function getAll($request)
    {
        try {
            $transformedEducands = array();
            if (auth()->user()) {
                $educands = $this->educandRepo->getAll(auth()->user());
            }
            foreach ($educands as $educand) {
                $transformedEducand = EducandTransformerForId::transform($educand, $request);
                array_push($transformedEducands, $transformedEducand);
            }
            return $transformedEducands;
        } catch (\Exception $exception) {

            return null;
        }
    }

    public function getTrackByEducandId(Educand $educand)
    {
        try {
            $educand = $this->educandRepo->getEducandWithdata($educand);

            $transformedTasks = array();

            if ($educand->track) {
                $transformedTrack = TrackTransformer::transform($educand->track);

                foreach ($educand->track->tasks as $task) {

                    $transformedTask = TaskTransformer::transform($task);

                    array_push($transformedTasks, $transformedTask);
                }

                $transformedTrack['tasks'] = $transformedTasks;

                foreach ($educand->track->tasks as $index => $task) {

                    $transformedTrack['tasks'][$index]['station'] = StationTransformer::transform($task->station);

                }

                foreach ($educand->track->tasks as $index => $task) {

                    $transformedTrack['tasks'][$index]['station']['site'] = SiteTransformer::transform($task->station->site);
                }

                return $transformedTrack;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function startTrack(Educand $educand)
    {
        try {
            $track = $this->getTrackByEducandId($educand);
            if ($track) {
                $educandTaskTrack = new EducandTaskTrack;
                $educandTaskTrack->educand_id = $educand->id;
                $educandTaskTrack->track_id = $track['id'];
                $educandTaskTrack->start_date = Carbon::now();
                $educandTaskTrack->end_date = null;
                $educandTaskTrack->help_count = 0;
                $educandTaskTrack->save();

                return 'success';
            } else {

                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function endTrack(Educand $educand, Request $dataEntries)
    {
        try {
            $track = $this->getTrackByEducandId($educand);
            if ($track) {
                $educandTaskTrack = $this->educandRepo->findTrackById($track);
                $educandTaskTrack->end_date = Carbon::now();
                $educandTaskTrack->save();
                foreach ($dataEntries->data as $dataEntry) {
                    $newEducandTaskTrack = new EducandTaskTrack;
                    $newEducandTaskTrack->educand_id = $educand->id;
                    $newEducandTaskTrack->track_id = $track['id'];
                    $newEducandTaskTrack->start_date = Carbon::parse($dataEntry['start']);
                    $newEducandTaskTrack->end_date = Carbon::parse($dataEntry['end']);
                    $newEducandTaskTrack->help_count = $dataEntry['help_count'];
                    $newEducandTaskTrack->item_type = $dataEntry['type'];
                    $newEducandTaskTrack->item_id = $dataEntry['id'];
                    $newEducandTaskTrack->save();
                }

                return 'success';
            } else {

                return null;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function askForHelp(Educand $educand, Task $task)
    {
        try {
            $track = $this->getTrackByEducandId($educand);
            if ($track) {

                //Todo send message to server that help is needed for this specific task

                $send = new Send();
//                $send->from = '050000000';
                $send->ms = false;
                $send->list = $task->station->site->helper_phone;
                $send->msg = EducandService::$messageText;


                try {
                    Micropay::send($send);
                } catch (SendException $e) {

                    $e->getMessage();
                }

                return 'success';

            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }

    }

    public function zipfiles(Educand $educand)
    {
        File::deleteDirectory('zip');

        $educandTrack = $this->getTrackByEducandId($educand);

        $imagesPath = public_path() . '/zip/images/';
        File::deleteDirectory($imagesPath);

        File::makeDirectory($imagesPath, $mode = 0777, true, true);
        $audioPath = public_path() . '/zip/audio/';
        File::deleteDirectory($audioPath);
        File::makeDirectory($audioPath, $mode = 0777, true, true);

        if (isset($educandTrack['tasks'])) {

            foreach ($educandTrack['tasks'] as $task) {

                $taskVisualPathArray = explode('/', $task['visual_resource']);
                $taskVisualFile = end($taskVisualPathArray);

                $stationVisualPathArray = explode('/', $task['station']['visual_resource']);
                $stationVisualFile = end($stationVisualPathArray);

                $siteVisualPathArray = explode('/', $task['station']['site']['visual_resource']);
                $siteVisualFile = end($siteVisualPathArray);

                $taskAudioPathArray = explode('/', $task['audio_resource']);
                $taskAudioFile = end($taskAudioPathArray);

                $siteAudioPathArray = explode('/', $task['station']['site']['audio_resource']);
                $siteAudioFile = end($siteAudioPathArray);

                $siteHelperAudioPathArray = explode('/', $task['station']['site']['helper']['phone_audio']);
                $siteHelperAudioFile = end($siteHelperAudioPathArray);

                if (file_exists('uploads/original/' . $task['visual_resource'])) {
                    File::copy('uploads/original/' . $task['visual_resource'], 'zip/images/' . $taskVisualFile);
                }
                if (file_exists('uploads/original/' . $task['station']['visual_resource'])) {
                    File::copy('uploads/original/' . $task['station']['visual_resource'], 'zip/images/' . $stationVisualFile);
                }
                if (file_exists('uploads/original/' . $task['station']['site']['visual_resource'])) {
                    File::copy('uploads/original/' . $task['station']['site']['visual_resource'], 'zip/images/' . $siteVisualFile);
                }
                if (file_exists('uploads/original/' . $task['audio_resource'])) {
                    File::copy('uploads/original/' . $task['audio_resource'], 'zip/audio/' . $taskAudioFile);
                }
                if (file_exists('uploads/original/' . $task['station']['site']['audio_resource'])) {
                    File::copy('uploads/original/' . $task['station']['site']['audio_resource'], 'zip/audio/' . $siteAudioFile);
                }

//        File::copy('uploads/original/' . $task['station']['site']['helper']['phone_audio'], 'zip/audio/' . $siteHelperAudioFile);


            }
        if(isset($educand->visual_resource_path)) {
        if(file_exists('uploads/original/' . $educand->visual_resource_path)) {
            File::copy('uploads/original/' . $educand->visual_resource_path, 'zip/images/' . $educand->visual_resource_path);
        }
    }
    if(isset($educand->qr_instructions_path)) {
        if(file_exists('uploads/original/' . $educand->qr_instructions_path)) {
            File::copy('uploads/original/' . $educand->qr_instructions_path, 'zip/audio/' . $educand->qr_instructions_path);
        }
    }
}

        $zip = Zip::create($educand->id . '.zip');
        $zip->add('zip');
        $zip->close();

        File::deleteDirectory('zip');
    }

    public function getEducands()
    {
        $admin = AdminFacade::getLoggedInAdmin();
        return $this->educandRepo->getEducands($admin);
    }

    public function validateEducandRequest(Request $request)
    {
        $validatedData = $request->validate([
            'full_name1' => 'required',
            'full_name2' => 'required',
            'about_me' => 'nullable',
            'address' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'contact_first_name' => 'required',
            'contact_last_name' => 'required',
            'contact_last_email' => 'required|email',
            'contact_last_phone' => 'required|regex:/(0)[0-9]{9}/',
            'gender' => 'required',
            'visual_resource_path' => 'required|regex:/(.+).jpeg/i',
            'current_state' => 'required',
            'birth_date' => 'required',
            'qr_instructions_path' => 'required|regex:/(.+).mpga/i'

        ]);

        return $validatedData;
    }

    public function save(array $data, int $educandId = null)
    {
        $data['admin_id'] = auth()->guard('admins')->user()->id;
        return $this->educandRepo->save($data, $educandId);
    }

    public function delete(int $educandId)
    {
        $user = auth()->guard('admins')->user();
        return $this->educandRepo->delete($educandId, $user);
    }

    public function assign(Request $request, int $trackId)
    {
        $user = auth()->guard('admins')->user();
        return $this->educandRepo->assign($request, $trackId, $user);
    }
}