<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comments;

class DashboardCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comments $comments)
    {
        $allComments = $comments->where('status', 'active')
                        ->latest()
                        ->get();
        $newComments = [];
        foreach($allComments as $c) {
            if($c->post->user->id == auth()->user()->id) {
                $newComments[] = $c;
            }
        }

        $commentsHidden = $comments->where('status', 'hidden')
                            ->latest()
                            ->get();
        $newCommentsHidden = [];
        foreach($commentsHidden as $c) {
            if($c->post->user->id == auth()->user()->id) {
                $newCommentsHidden[] = $c;
            }
        }

        return view('dashboard.comments.index', [
            'title' => 'Comments',
            'comments' => $newComments,
            'hidden' => $newCommentsHidden
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comments::find($id);
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Comments::where('id', $id)
            ->update([
                'status' => $request->status
            ]);
        return redirect('/dashboard/comments?status=active')->with('success', "Comment change to $request->status successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comments::destroy($id);
        return redirect('/dashboard/comments?status=active')->with('success', 'Comment deleted successfully');
    }
}
