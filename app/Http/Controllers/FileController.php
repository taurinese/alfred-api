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
        // Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();
        // OU
        /* $result = $request->url_image->storeOnCloudinaryAs('posts', $image_name);
        $post->url_image = $result->getPath();
        $post->cloudinary_id = $result->getPublicId(); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
