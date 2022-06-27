<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();

        return response()->json([
            'success' => true,
            'data' => $statuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'type' => 'string|required'
        ]);

        $status = new Status([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::find($id);

        if(!$status){
            return response()->json([
                'success' => false
            ], 404);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $status
            ], 200);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'type' => 'string'
        ]);

        $status = Status::find($id);

        if($status){
            if($request->name) $status->name = $request->name;
            if($request->type) $status->type = $request->type;
            $status->save();
            return response()->json([
                'success' => true,
                'data' => $status
            ], 200);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        if($status){
            $status->destroy();
            return response()->json([], 204);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
        }
    }
}
