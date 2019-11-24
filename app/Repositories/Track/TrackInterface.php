<?php

namespace App\Repositories\Track;

use Illuminate\Http\Request;

interface TrackInterface
{
    public function getById($trackId);

    public function getTracks($adminId);

    public function setPublic(Request $request, int $adminId);

    public function saveTrack(array $trackData, int $trackId = null);

    public function deleteTrack(int $trackId, $user);
}