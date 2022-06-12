<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: retourner seulement les fields selon le status du user?

        $fields = Field::all();

        return response()->json([
            "success" => true,
            "fields" => $fields
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
            'name' => 'string'
        ]);

        $field = new Field();

        return response()->json([
            'success' => true,
            'field' => $field
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
        $field = Field::find($id);


        if(!$field){
            $response = [
                'success' => false
            ];
        }
        else{
            $response = [
                'success' => true,
                'field' => $field
            ];
        }

        // Retour
        return response()->json($response, $response['success'] ? 200 : 404);

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
            'name' => 'string'
        ]);

        $field = Field::find($id);
        $field->name = $request->name;
        $field->save();

        return response()->json([
            'success' => true,
            'field' => $field
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field = Field::find($id);

        if(!$field){
            return response()->json([
                'success' => false
            ], 404);
        }
        else{
            return response()->json([], 204);
        }
    }
}
