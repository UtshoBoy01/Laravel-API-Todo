<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        if(!$validatedData){
            return response()->json([
                'error' => "okok"], 422);
        }

        $post = Todo::create([
            'title' => $request->title,
            'body'  => $request->body ?? null, // No need for an if-else condition
        ]);

        $response= [
            'post' => $post,
            'success' => " Create Success"
        ];

        return response()->json($response, 201); // Returns a proper JSON response with a status code
    }
    function index_id($id){}



    // }
    // public function store(Request $request)
    // {
    // }

    // public function show(Todo $todo)
    // {
    // }
    // public function edit(Todo $todo)
    // {
    // }
    // public function update(Request $request, Todo $todo)
    // {
    // }
    // public function destroy(Todo $todo)
    // {
    // }
}