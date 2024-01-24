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


        $results = [];
        $totalVotes = 0;
         foreach ($poll->questions as $question) 
         {
            $totalVotes = Result::where('question_id', $question->id)->count();

            foreach ($question->chooses as $choice) 
            {
                $votesCount = Result::where('question_id', $question->id)
                                    ->where('answer_id', $choice->id)
                                    ->count();
                $percentage = $totalVotes > 0 ? ($votesCount / $totalVotes) * 100 : 0;
                $percentage = number_format($percentage, 2);
                $results[$question->content][$choice->content] = $percentage;
            }
        }
        
        return view('platform.results.show',compact('poll','comments','results','totalVotes'));
    }

    public function check_is_already_participating($survey_id)
    {
        $is_already_participating = Result::where('survey_id',$survey_id)->where('user_id',auth()->id())->first();

        if ($is_already_participating) return true;
        
        return false;
    }

    public function store(Request $request)
    {
        try 
        {
            $data = [];
            $answers = $request->input('answers');
            $survey_id = $request->input('survey_id');
            if (!$survey_id) {
                throw new Exception('حدث خلل برمجي');
            }
            
            $is_already_participating = $this->check_is_already_participating($survey_id);

            if ($is_already_participating) 
            {
                throw new Exception('لقد شاركت بهذا الاستبيان من قبل');
            }
            else 
            {
                foreach ($answers as $answer) 
                {
                    $validator = Validator::make($answer, [
                        'question_id' => 'required',
                        'ip' => 'required',
                        'city' => 'required',
                        'content' => 'required',
                        'answer_id' => 'required',
                    ]);
        
        
                    if ($validator->fails()) 
                    {
                        throw new Exception('هناك نقص في البيانات المدخلة');
                    }
                    else 
                    {
                        $result = new Result();
                        $result->ip = $answer['ip'];
                        $result->question_id = $answer['question_id'];
                        $result->answer_id = $answer['answer_id'];
                        $result->content = $answer['content'];
                        $result->city = $answer['city'];
                        $result->survey_id = $survey_id;
                        $result->user_id = auth()->id();
                        
                        if (!$result->save()) 
                        {
                            throw new Exception('حدث خطأ في تخزين البيانات');
                        }
                       
                    }
                    
                }

                $data['success'] = 1;
                $data['msg'] = 'تمت المعالجة بنجاح';
                return response()->json($data);
        
                
            }
        }
        catch(Exception $ex)
        {
            $data['success'] = 0;
            $data['msg'] = $ex->getMessage();
            return response()->json($data);
        }
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

