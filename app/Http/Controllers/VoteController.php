<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        if(Auth::user()->role === 'admin'){
            $votes = Vote::orderBy('created_at','desc')->get();
            return view('admin.votes.index',compact('votes'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $votes = Vote::orderBy('created_at','desc')->get();
        return view('platform.vote.create',['votes'=>$votes]);
    }
    public function mysubjects()
    {
        return view('platform.vote.mysubjects');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:votes',
            // 'image'=>'required',
        ]);

        $img_path = null;

        if ($request->hasFile('image')) 
        {
            $img_path = $request->file('image')->store('images', 'custom_disk');

            if (!$img_path) 
                $request->session()->flash('error_store', ' سحدث خطأ في إضافة صورة الرأي ، سيتم استخدام الصورة الافتراضية');
            
        } 
        else{
            $request->session()->flash('default_image', 'تنويه : لم تقم بإضافة صورة لذلك سيتم استخدام الصورة الافتراضية');
        }
        
        $vote = Vote::create([
            'title'=>$request->title,
            'image'=>$img_path,
            'user_id'=>Auth::user()->id,
            'title_slug'=>str_replace(' ','-',$request->title),
        ]);

        if ($vote) {
            $request->session()->flash('success_store', 'تم إضافة الرأي بنجاح');
        }else{
            $request->session()->flash('error_store', 'حدث خطأ في إضافة الرأي');
        }
      
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vote $vote)
    {
        if(Auth::user()->role === 'admin'){
            $vote->update([
                'status'=>$request->status,
            ]);
            return 'done';
        }else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();
        return back();
    }

    public function poll($id){
        $votes = Vote::where('title_slug',$id)->first();
        if (!$votes) {
            abort(404);
        }
        return view('platform.vote.poll',compact('votes'));
    }
}
