<?php

namespace App\Http\Controllers;

use App\Models\choise;
use App\Models\Choise as ModelsChoise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChoiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $choose = ModelsChoise::create($request->all());
        
        if (!$choose) {
            return response()->json(['message' => 'حدث خطأ في إضافة الاختيارات'], 500);
        }
        return $choose;
    }

    /**
     * Display the specified resource.
     */
    public function show(choise $choise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(choise $choise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, choise $choise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(choise $choise)
    {
        //
    }
}
