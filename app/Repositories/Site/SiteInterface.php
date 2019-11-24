<?php

namespace App\Repositories\Site;

interface SiteInterface
{
    public function getById($siteId);

    public function getSites($adminId);
}