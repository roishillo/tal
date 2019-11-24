<?php

namespace App\Models\Transformers;

use App\Models\Entities\Site;
use App\Models\Transformers\BaseTransformerAbstract;
use League\Fractal;

class SiteTransformer extends BaseTransformerAbstract
{
    public static function transform(Site $site)
    {
        $visualPath = explode('/', $site->visual_resource_path);
        $visualPath = end($visualPath);

        $helperAudioPath = explode('/', $site->helper_phone_audio_path);
        $helperAudioPath = end($helperAudioPath);

        return [
            'id' => (int)$site->id,
            'name' => (string)$site->name,
            'address' => (string)$site->address,
            'web_link' => (string)$site->web_link,
            'visual_resource' => (string)$visualPath,
            'audio_resource' => (string)$site->audio_resource_path,
            'wifi_name' => (string)$site->wifi_name,
            'wifi_password' => (string)$site->wifi_password,
            'helper' => [
                            'name' => (string)$site->helper_name,
                            'phone' => (string)$site->helper_phone,
                            'phone_audio' => (string)$helperAudioPath,
                            'phone_whatsapp' => (string)$site->helper_phone_whatsapp
                        ]
        ];
    }
}