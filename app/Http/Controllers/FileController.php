<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\File;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = auth()->user()->files;
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
        // $request->validate([
        //     'document' => 'file|mimes:jpg,png,bmp,pdf|required'
        // ]);


        

        $file = new File();
        // $result = $request->document->storeOnCloudinary();
        $folderName = $request->guarantor_id ? auth()->id() . '_guarantor' : auth()->id();
        $result = $request->document->storeOnCloudinaryAs($folderName, auth()->id() . '_' . Str::slug(Field::find($request->field_id)->name, '_'));
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
            'data' => $file
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


        $file = File::where('id', $id)->where('user_id', auth()->id())->first();
        if($file){
            Cloudinary::destroy($file->cloudinary_id);
            $file->delete();
            // return response()->json([], 204);

            $newFile = new File();
            // $result = $request->document->storeOnCloudinary();
            $result = $request->document->storeOnCloudinaryAs(auth()->id(), auth()->id() . '_' . Str::slug(Field::find($request->field_id)->name, '_'));
            $newFile->path = $result->getPath();
            $newFile->cloudinary_id = $result->getPublicId();
            $newFile->field_id = $request->field_id;
            if($request->guarantor_id){
                $newFile->guarantor_id = $request->guarantor_id;
            }
            else{
                $newFile->user_id = auth()->id();
            }
            $newFile->save();

            return response()->json([
                'success' => true,
                'data' => $newFile
            ], 200);
        }
        else{
            return response()->json(['success' => false], 404);
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
        // Vérifier si le fichier existe et qu'il appartient au user
        $file = File::where('id', $id)->where('user_id', auth()->id());
        $file = auth()->user()->guarantors ? $file->orWhere('guarantor_id', auth()->user()->guarantors)->first() : $file->first();
        // dd($file);
        if($file){
            Cloudinary::destroy($file->cloudinary_id);
            $file->delete();
            return response()->json([], 204);
        }
        else{
            return response()->json(['success' => false], 404);
        }
    }
}
