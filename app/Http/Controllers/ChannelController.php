<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function getChannels()
    {
        $channels = Channel::latest()->paginate(5);

        return ChannelResource::collection($channels);
    }
}
