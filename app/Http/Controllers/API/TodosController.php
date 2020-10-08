<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoResourceCollection;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TodoResourceCollection
     */
    public function index()
    {
        $todos = Todo::latest()->get();
        return (new TodoResourceCollection($todos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Todo::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return response()->json(['message' => "Success to add!", 'data' => []], 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return TodoResource
     */
    public function show(Todo $todo)
    {
        return (new TodoResource($todo))->additional(['message' => '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $todo->update([
            'title' => $request->title
        ]);

        return response()->json(['message' => 'Success to update', 'data' => [$todo]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     * @return Response
     * @throws \Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['message' => 'Deleted', 'data' => ''], 200);
    }

    /**
     * Mark an item as completed
     *
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsCompleted(Todo $todo)
    {
        $todo->update([
            'is_completed' => 1
        ]);

        return response()->json(['message' => 'Already mark as completed', 'data' => ''], 200);
    }
}
