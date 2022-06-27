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
                'data' => $user
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
        // Validation TODO: vérifier ce qu'il autoriser à update
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'birthday' => 'date',
            'status_id' => 'integer'
        ]); 
        // Récupération du nouveau user

        $user = User::find($id);
        if($user) {
            $user->fill($request->all())->save();
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        }
        else{
            return response()->json([
                'success' => false
            ], 404);
        }

        // Retour

        return response()->json([
            'success' => true,
            'data' => $user
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
        $user = User::find($id);
        if($user){
            $user->destroy();
            return response()->json([
                'success' => true
            ]);
        }
        else{
            return response()->json([], 204);
        }
    }
}
