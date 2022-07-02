<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Models\Notes;
use App\Http\Resources\Notes as NotesResource;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Notes\NoteValidator;

class NotesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Notes::all();

        return $this->sendResponse(NotesResource::collection($notes), 'Full list display complete.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  NotesResource $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteValidator $request)
    {
        $validated = $request->validated();
        $note = Notes::create($validated);
        return $this->sendResponse(new NotesResource($note), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Notes::find($id);

        if (is_null($note)) {
            return $this->sendError('Note not found.');
        }

        return $this->sendResponse(new NotesResource($note), 'Note retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteValidator $request, $id)
    {
        $validated = $request->validated();

        if(Notes::where(['id' => $id])->exists()){
            Notes::find($id)->update($validated);

            return $this->sendResponse(new NotesResource(Notes::find($id)), 'Note updated successfully.');
        }

        return $this->sendError('Note not found.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $note)
    {
        $note->delete();

        return $this->sendResponse([], 'Note deleted successfully.');
    }
}
