<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        return response()->json([
            'success' => true,
            'data' => $files
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
            'document' => 'file|mimes:jpg,png,bmp,pdf|required'
        ]);


        

        // Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();
        // OU
        $file = new File();
        $result = $request->file('document')->storeOnCloudinaryAs('files', $request->file('document')->getClientOriginalName());
        $file->path = $result->getPath();
        $file->cloudinary_id = $result->getPublicId();
        $file->field_id = $request->field_id;
        if($request->guarantor_id){
            $file->guarantor_id = $request->guarantor_id;
        }
        else{
            $file->user_id = auth()->id();
        }
        $file->save();

        return response()->json([
            'success' => true,
            // 'data' => $file
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
        $file = File::find($id);

        if($file){
            return response()->json([
                'success' => true,
                'data' => $file
            ], 200);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
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

        // Validation sur le nouveau fichier dans la request

        // Vérifier que le fichier existe bien

        // Supprimer le fichier de Cloudinary

        // Upload le nouveau fichier 

        // Update l'url dans la db


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
