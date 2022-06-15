<?php

namespace App\Http\Controllers;

use App\Models\RentalFile;
use Illuminate\Http\Request;

class RentalFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rental_files = RentalFile::all();

        return response()->json([
            'success' => true,
            'data' => $rental_files
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
            'url' => 'string',
            'title' => 'string',
            'agency' => 'string',
            'description' => 'string',
            'city' => 'string',
            'price' => 'string',
            'images_url' => 'string',
            'status_id' => 'string'
        ]);

        $rental_file = new RentalFile($request->all());

        return response()->json([
            'success' => true,
            'data' => $rental_file
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
        $rental_file = RentalFile::find($id);

        if(!$rental_file){
            return response()->json([
                'success' => false
            ], 404);
        }
        else{
            return response()->json([
                'success' => true,
                'data' => $rental_file
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
            'url' => 'string',
            'title' => 'string',
            'agency' => 'string',
            'description' => 'string',
            'city' => 'string',
            'price' => 'string',
            'images_url' => 'string',
            'status_id' => 'exists:statuses,id'
        ]);

        $rental_file = RentalFile::find($id);

        if($rental_file){
            $rental_file->fill($request->all())->save(); // voir si ça fonctionne
            return response()->json([
                'success' => true,
                'data' => $rental_file
            ]);
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
        $rental_file = RentalFile::find($id);
        if($rental_file){
            $rental_file->destroy();
            return response()->json([], 204);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
        }
    }
}
