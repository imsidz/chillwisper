<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Http\Resources\VideoResource;
use App\Models\Channel;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function addVideo(Request $request)
    {   
        $videoId = Youtube::parseVidFromURL($request->video);
        $video = Video::where('videoId', $videoId)->first();

        if($video){
            return response()->json(['errors' => [
                'video' => [
                    'This video already in our database'
                ]
            ]]);
        }
        $video = Youtube::getVideoInfo($videoId);
        $channel = Channel::where('channelId', $video->snippet->channelId)->first();
        if(!$channel){
            $chan = Youtube::getChannelById($video->snippet->channelId);
            $channel = new Channel;
            $channel->channelId = $video->snippet->channelId;
            $channel->title = $chan->snippet->title;
            $channel->description = $chan->snippet->description;
            $channel->customurl = $chan->snippet->customUrl;
            $channelDate = date('Y-m-d h:i:s', strtotime($chan->snippet->publishedAt));
            $channel->publishedAt = $channelDate;
            $channel->thumbnail = $chan->snippet->thumbnails->medium->url;
            $channel->save();
        }

        $v = new Video;
        $v->videoId = $videoId;
        $v->title = $video->snippet->title;
        $v->description = $video->snippet->description;
        // dd($video);
        $v->thumbnail = $video->snippet->thumbnails->medium->url;
        $videoDate = date('Y-m-d h:i:s', strtotime($video->snippet->publishedAt));
        $v->publishedAt = $videoDate;
        $v->channel_id = $channel->id;
        $v->save();

        foreach($video->snippet->tags as $tag){
            $t = Tag::where('name', $tag)->first();
            if(!$t){
                $t = new Tag;
                $t->name = $tag;
                $t->save();
            }

            $t->videos()->attach($v->id);
        }

        return response()->json(['message' => 'Video Added Success']);
        
    }

    public function getVideos()
    {
        $videos = Video::latest()->paginate(20);

        return VideoResource::collection($videos);
    }

    public function getVideo($id)
    {
        $video = Video::where('videoId', $id)->first();

        return new VideoResource($video);
    }
}
