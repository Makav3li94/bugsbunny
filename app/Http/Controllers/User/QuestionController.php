<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $challenge = Section::findOrFail($request->id);

        return response()->json(['questions' => $challenge->questions]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'explanation' => 'required|string',
            'answer.*' => 'required|string',
            'answer' => "required|array|min:4",
            'is_active_answer.*' => 'required|string',
            'is_active_answer' => "required|array|min:1",
        ]);

        $question = Question::create([
            'question' => $request->question,
            'explanation' => $request->explanation,
            'is_active' => isset($request->is_active) ? '1' : '0',
            'unit' => isset($request->unit) ? $request->unit : 1,
            'user_id' => auth()->id(),
            'section_id' => $request->section_id,
        ]);
        foreach ($request->answer as $key => $answer)
            Answer::create([
                'answer' => $answer,
                'is_checked' => isset($request->is_active_answer[$key]) ? '1' : '0',
                'question_id' => $question->id,
            ]);

        return redirect()->back()->with('create', 'success');
    }

    public function edit(Request $request, Question $question)
    {
        $question = $question->with('answers')->get();
        if ($request->ajax()) {
            return response()->json(['question' => $question]);
        }
    }


    public function update(Request $request, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'explanation' => 'required|string',
            'answer.*' => 'required|string',
            'answer' => "required|array|min:4",
            'is_active_answer.*' => 'required|string',
            'is_active_answer' => "required|array|min:1",
        ]);
        if ($validator->fails()) {
            return response()->json(['collapseCatError' => $validator->errors()->toArray()]);
        }
        $question->update([
            'question' => $request->question,
            'explanation' => $request->explanation,
            'is_active' => isset($request->is_active) ? '1' : '0',
            'unit' => isset($request->unit) ? $request->unit : 1,
        ]);
        $counter = 0;
        foreach ($question->answers as $answer) {
            $answer->update([
                'answer' => $request->answer[$counter],
                'is_checked' => isset($request->is_active_answer[$counter]) ? '1' : '0',
            ]);
            $counter++;
        }
        return redirect()->back()->with('update', 'success');
    }


    public function destroy(Question $question)
    {
        //
    }
}
