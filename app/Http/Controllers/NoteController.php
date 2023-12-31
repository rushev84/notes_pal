<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\View\Components\NoteComponent;

class NoteController extends Controller
{
    public function create(CreateNoteRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        $note = new Note;
        $note->user_id = Auth::user()->id;
        $note->title = $title;
        $note->content = $content;
        $note->save();

        $html = Blade::renderComponent(new NoteComponent($note));

        return response()
            ->json([
                'success' => true,
                'html' => $html,
            ])
            ->header('Content-Type', 'application/json');
    }

    public function update(UpdateNoteRequest $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');

        $note = Note::find($id);
        $note->title = $title;
        $note->content = $content;
        $note->save();

        return response()
            ->json([
                'success' => true,
            ])
            ->header('Content-Type', 'application/json');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $note = Note::find($id);
        $note->delete();

        return response()
            ->json([
                'success' => true,
            ])
            ->header('Content-Type', 'application/json');
    }
}
