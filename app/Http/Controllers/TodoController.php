<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }
    
    public function create(Request $request){

        // $request->validate([
        //     'title' => 'required',
        // ]);

        // $post = Todo::create([
        //     'title' => $request->title,
        //     'body'  => $request->body ?? null,
        // ]);

        // $response= [
        //     'post' => $post,
        //     'success' => " Create Success"
        // ];

        // return response()->json($response, 201); 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }
    
        $post = Todo::create([
            'title' => $request->title,
        ]);
    
        return response()->json([
            'post' => $post,
            'success' => "Create Success"
        ], 201);
    }
    
    function index_id($id){
        $todo = Todo::find($id);
        return response()->json($todo);
    }



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