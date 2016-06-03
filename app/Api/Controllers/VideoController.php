<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Video;

class VideoController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$videos 			= array('videos' => Video::all());
		$videos['count'] 	= count($videos['videos']);
        echo json_encode($videos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$video = array('video' => Video::find($id));
		echo json_encode($video);
    }
}
