<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Récupération de l'info

        $user = User::find($id);

        if(!$user){
            $response = [
                'success' => false
            ];
        }
        else{
            $response = [
                'success' => true,
                'user' => $user
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
        // Validation
        /* $request->validate([

        ]); */
        // Changement des data

        // Récupération du nouveau user

        $user = User::find($id);

        // Retour

        return response()->json([
            'success' => true,
            'user' => $user
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
        if(User::exists($id)){
            return response()->json([
                'success' => true
            ]);
        }
        else{
            return response()->json([], 204);
        }
    }
}
