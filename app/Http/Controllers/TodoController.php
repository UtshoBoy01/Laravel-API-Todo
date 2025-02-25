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
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return response()->json($todos);
    }
    
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }
    
        $post = Todo::create([
            'title' => $request->title,
            'body' => $request->body ?? null,
        ]);
    
        // return response()->json([
        //     'post' => $post,
        //     'success' => "Create Success"
        // ], 201);
        return response()->json($post, 201);
    }

    function index_id($id){
        $todo = Todo::find($id);
        return response()->json($todo);
    }

    function update(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'nullable|string',
        ],); 
        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ],422);
        }
        $post= Todo::where('id',$request->id)->update([
            'title' => $request->title,
            'body' => $request->body ?? null,
        ]);
        return response()->json([
            'post' => $post,
            'success' => "Update Success"
        ], 201);
    }

    function delete($id){
        $id = Todo::find($id);
        if(!$id){
            // return response()->json([
            //     'errors'=> 'Id not Find'
            // ]);
            //!  or
            // return [
            //     'errors' => 'Id not Find...'
            // ];
            //!  or
            return [
                'errors' => [
                    'fail'=> ['Id not Find...']
                ]
            ];
        };
        
        $id->delete();
        // return response()->json([
        //     'success'=>"Delete Success"
        // ]);
        return [
            'Success' => 'Delete Success...'
        ];
    }

}