<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::where("parent_id", null)->with("childs.childs.childs.childs")->get(); // FIXME
        return response()->json(['data' => $comments], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Like the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        //
    }

    /**
     * Dislike the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
