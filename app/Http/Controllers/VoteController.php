<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Vote;
use App\Models\Choise as ModelsChoise;
use Exception;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Storage;

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

    public function getMySubjects()
    {
        $user_votes = Vote::where('user_id',auth()->id())->get();
        return view('platform.vote.my_subjects')->with('user_votes', $user_votes);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [];
        $file_path = '';
        $file_full_path = '';
        $vote = null;
        $vote_id = null;
        
        try
        {
            //First of all , checking validation rules
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:votes',
                'image' => 'file|mimetypes:image/*,video/*'
            ]);

            if ($validator->fails()) 
            {
                if ($validator->errors()->has('title')) 
                {
                    throw new Exception('العنوان موجود مسبقاً .. الرجاء إدخال عنوان آخر');
                } 
                elseif ($validator->errors()->has('image')) 
                {
                    throw new Exception('خطأ في صيغة الملف');
                } 
            }
            
             //First , handle the image/video
            // 'image' can be image or video
            if ($request->hasFile('image')) 
            {
                $file = $request->file('image');
                $mimeType = $file->getMimeType();
                if (strpos($mimeType, 'image') !== false) 
                {
                    $img_path = $request->file('image')->store('images', 'public');
                    $file_full_path = storage_path('app/public/'.$img_path);
                    if (!$img_path) 
                    {
                        throw new Exception('حدث خطأ في تخزين الصورة');
                    }
                    else
                    {
                        $file_path = $img_path;
                    }
                } 
                elseif (strpos($mimeType, 'video') !== false) 
                {
                    $video_path = $request->file('image')->store('videos', 'public');
                    $file_full_path = storage_path('app/public/'.$video_path);
                    if (!$video_path) 
                    {
                        throw new Exception('حدث خطأ في تخزين الفيديو');
                    }
                    else
                    {
                        $getID3 = new getID3;
                        $videoFileInfo = $getID3->analyze($file_full_path);
                        $durationSeconds = $videoFileInfo['playtime_seconds'];
                        if ($durationSeconds > 20) 
                        {
                            throw new Exception('يجب ألا تتجاوز مدة الفيديو 20 ثانية');
                        }
                        else
                        {
                            $file_path = $video_path;
                        }
                    }
                }
            } 

            //questions and choices
            $questions_and_choices = [];
            foreach ($request->questions as $item) 
            {
                $question = $item["question"];
                $choices = array_slice($item, 1); // Remove the first element (question) from the array
                $questions_and_choices[] = ["question" => $question, "choices" => $choices];
            }

            $vote = Vote::create([
                'title'=>$request->title,
                'image'=>$file_path,
                'user_id'=>Auth::user()->id,
                'title_slug'=>str_replace(' ','-',$request->title),
            ]);
            if ($vote) 
            {
                $vote_id = $vote->id;
                //create question
                foreach ($questions_and_choices as $question_and_choice) 
                {
                    $question = new Question();
                    $question->content = $question_and_choice['question'];
                    $question->vote_id = $vote_id;
                    $question->save();
            
                    foreach ($question_and_choice['choices'] as $choiceText) 
                    {
                        if (!$choiceText) continue;

                        $choice = new ModelsChoise();
                        $choice->content = $choiceText;
                        $question->chooses()->save($choice);
                    }
                }
                
            }
            else
            {
                throw new Exception('حدث خطأ في إضافة الموضوع');
            }
            $data['success'] = 1;
            $data['msg'] = 'تمت المعالجة بنجاح';
            
            return response()->json($data);
        }
        catch(Exception $ex)
        {
            if ($vote) 
            {
                $vote->delete();
            }
            if(File::exists($file_full_path)) 
            {
                File::delete($file_full_path);
            }
            $data['success'] = 0;
            $data['msg'] = $ex->getMessage();
            return response()->json($data);
        }
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
        $resultController = new ResultController();

        $vote = Vote::where('title_slug',$id)->first();
        if (!$vote) {
            abort(404);
        }

        $is_already_participating = false;
        if ($resultController->check_is_already_participating($vote->id)) {
            $is_already_participating = true;
        }
        
        return view('platform.vote.poll')->with('vote',$vote)->with('is_already_participating',$is_already_participating);
    }
}
