<?php

namespace App\Http\Controllers;

use App\Models\Guarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guarantors = auth()->user()->guarantors();

        return response()->json([
            'success' => true,
            'data' => $guarantors
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
            'first_name' => 'string',
            'last_name' => 'string',
            'user_id' => 'exists:users,id'
        ]);

        $guarantor = new Guarantor($request->all());
        $guarantor->save();

        $data = [
            'first_name' => $guarantor->first_name,
            'last_name' => $guarantor->last_name,
            'id' => $guarantor->id
        ];


        return response()->json([
            'success' => true,
            'data' => $data
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
        $guarantor = Guarantor::find($id);

        if($guarantor){
            return response()->json([
                'success' => true,
                'data' => $guarantor
            ]);
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
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
        ]);

        $guarantor = Guarantor::find($id);

        if($guarantor){
            $guarantor->fill($request->all())->save();
            return response()->json([
                'success' => true,
                'data' => $guarantor
            ]);
        }
        else{
            return response()->json([
                'success' => false
            ]);
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
        $guarantor = Guarantor::find($id);

        if($guarantor){
            $files = $guarantor->files();
            foreach($files as $file){
                cloudinary()->uploadApi()->destroy($file->cloudinary_id);
            }
            $guarantor->destroy();
            return response()->json([], 204);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
        }
    }
}
