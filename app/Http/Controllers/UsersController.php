<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //consultar todos los usuarios
    public function index(){
        return User::paginate();
    }

    //consultar un usuario
    public function show($id){
        return User::find($id);
    }

    //crear un usuario
    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'rol' => 'required',
        ]);
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;

    }

    //actualizar usuario
    public function update(Request $request, $id){
        $this->validate($request, [
            'username' => 'filled|unique:users',
        ]);
        $user = User::find($id);
        if(!$user)return response('', 404);
        $user->update($request->all());
        if($request->passwprd) $user->password = Hash::make($request->password);
        $user->save();
        return $user;

    }

    //Eliminar usuario
    public function destroy($id){
        $user = User::find($id);
        if(!$user)return response('', 404);
        $user->delete();
        return $user;

    }
}
