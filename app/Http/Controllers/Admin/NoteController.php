<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    protected function store(Request $request, User $user)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['noteError' => $validator->errors()->toArray()]);
            }
            $description = $request->input('description');
            $description = nl2br($description);
            $record = Note::create([
                'user_id' => $user->id,
                'description' => $description,
            ]);
            $noteCounts = Note::where('user_id', $user->id)->get()->count();
            $note = [
                0 => $noteCounts,
                1 => $record->description,
                2 => $record->id
            ];
            return response()->json(['noteCreate' => 'submitted', 'note' => $note]);
        }
    }

    protected function edit(Request $request, Note $note)
    {
        if ($request->ajax()) {
            return response()->json(['note' => $note]);
        }
    }

    protected function update(Request $request, Note $note)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['collapseNoteError' => $validator->errors()->toArray()]);
            }
            $description = $request->input('description');
            $note->update([
                'description' => $description,
            ]);
            $note = [
                0 => $note->description,
                1 => $note->id
            ];
            return response()->json(['collapseNoteEdit' => 'success', 'note' => $note]);
        }
    }

    protected function destroy(Request $request, Note $note)
    {
        if ($request->ajax()) {
            $note->forceDelete();
            return response()->json(['deleteNote' => 'success']);
        }
    }
}
