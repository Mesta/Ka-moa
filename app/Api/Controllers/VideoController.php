<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;

use App\Video;

class VideoController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $videos = new Video();

        // Videos after from
        $from = $request->get('from');
        if($from !== null) {
            $videos = $videos->where('date', '>', $from);
        }

        // Videos before to
        $to = $request->get('to');
        if($to !== null) {
            $videos = $videos->where('date', '<', $to);
        }

        // Videos from realisator
        $realisator = $request->get('realisator');
        if($realisator !== null) {
            $videos = $videos->where('realisator', 'LIKE', '%' . $realisator . '%');
        }

        // Execute request & format json response
        $videos = $videos->get();
        $json   = array('videos'    => $videos,
                        'count'     => count($videos)
                    );
        return response()->json($json);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find record and format json response
        $video  = Video::find($id);
        $json   = array('video' => $video);

        return response()->json($json);
    }
}
