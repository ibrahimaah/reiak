<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    public function show($title)
    {
        $poll = Vote::where('title_slug',$title)->first();
        if(!$poll) abort(404);
        
        $comments = $poll->comments()->approved()->orderBy('created_at', 'desc')->get();

        return view('platform.results.show',compact('poll','comments'));
    }


    public function store(Request $request){
        $answers = $request->input('answers');
        foreach ($answers as $answer) {
            $validator = Validator::make($answer, [
                'survey_id' => 'required',
                'question_id' => [
                    'required',
                    Rule::unique('results')->where(function ($query) use ($answer) {
                        return $query->where('ip', $answer['ip']);
                    }),
                ],
                'ip' => 'required',
                'city' => 'required',
                'content' => 'required',
                'answer_id' => 'required',
            ]);


            if ($validator->fails()) {
                // Handle validation failure, you might want to return a response or take some other action
                return response()->json(['error' => $validator->errors()], 400);
            }

            Result::create($answer);
        }

        return 'created done';
    }



    public function storeComment(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'title_slug' => 'required',
                'comment' => 'required|min:3|max:1024'
            ]);
            
            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors',$errors);
            }

            $title_slug = $request->title_slug;
            $poll = Vote::where('title_slug',$title_slug)->first();
            $poll->comment($request->comment);
            $request->session()->flash('success-store-comment', 'تم إضافة تعليق بنجاح');
            // return redirect()->route('result.show',['id'=>$title_slug])->with('poll',$poll);
            return back();
        }
        catch(Exception $ex)
        {
            $request->session()->flash('error-store-comment', $ex->getMessage());
        }
    }


    public function updateComment(Request $request, string $id)
    {
        
        try 
        {
            $validator = Validator::make($request->all(), [
                'title_slug' => 'required',
                'comment' => 'required|min:3|max:1024'
            ]);
            
            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors',$errors);
            }


            $affectedRows = DB::table('comments')->where('id', $id)->update(['comment' => $request->comment]);
            if ($affectedRows > 0) {
                $request->session()->flash('success-update-comment', 'تم حفظ التعليق بنجاح');
            } else {
                $request->session()->flash('error-update-comment', 'حدث خطأ في حفظ التعليق');
            }

            // $title_slug = $request->title_slug;
            // $poll = Vote::where('title_slug',$title_slug)->first();            
            // return redirect()->route('result.show',['id'=>$title_slug])->with('poll',$poll);
            
            return back();
        }
        catch(Exception $ex)
        {
            $request->session()->flash('error-store-comment', $ex->getMessage());
        }
    }

    public function deleteComment(Request $request, string $id)
    {
        
        try 
        {
            $deletedRows = DB::table('comments')->where('id', "$id")->delete();
            
            if ($deletedRows > 0) {
                $request->session()->flash('success-delete-comment', 'تم حذف التعليق بنجاح');
            } else {
                $request->session()->flash('error-delete-comment', 'حدث خطأ ما');
            }
            
            // return redirect()->route('result.show',['id'=>$title_slug])->with('poll',$poll);
            return back();
        }
        catch(Exception $ex)
        {
            $request->session()->flash('error-store-comment', $ex->getMessage());
        }
    }
}

