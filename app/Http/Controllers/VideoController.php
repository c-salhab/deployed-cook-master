<?php
namespace App\Http\Controllers\Admin;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;
class VideoController extends Controller
{
    public function uploadVideo(Request $request)
    {
        $this->validate($request, [
            'video' => 'required|file|mimetypes:video/mp4',
        ]);
        $video = new Video;
        $video->title = $request->title;
        if ($request->hasFile('video'))
        {
            $path = $request->file('video')->store('videos', ['disk' => 'lessons']);
            $video->video = $path;
        }
        $video->save();
    }
}