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
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'explanation' => 'required|string',
            'answer.*' => 'required|string',
            'answer' => "required|array|min:4",
            'is_active_answer.*' => 'required|string',
            'is_active_answer' => "required|array|min:1",
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('for','question');
        }
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
        Section::find($request->section_id)->update(['status' => 1]);
        return redirect()->back()->with('create', 'success')->with('crud','section_store');
    }

    public function edit(Request $request, Question $question)
    {
        return $question = $question->load('answers:id,answer,is_checked,question_id')->toArray();
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
        $question->answers()->delete();
        $question->delete();
        return response()->json(['question' => 'deleted']);
    }
}
