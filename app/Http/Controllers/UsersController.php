<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{
    /**
     * create a new controller instance
     *
     * @return voidagre
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $roles = Role::all();
        $users = User::paginate(10);
        return view('usuarios.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Generate the password foreach user
     */
    function generatePassword()
    {
        $longitud = 20; // longitud del password
        $pass = substr(md5(rand()), 0, $longitud);
        return ($pass); // devuelve el password
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$contraseña =  $this->generatePassword(); //Esta variable se declarava para el uso de la funcion que genera una conntraseña aleatoria 

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('username', $request->username);
                })
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
                'role_id' => ['required', 'exists:roles,id'],
            ],

        ]);

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            //'password' => Hash::make($request['password']), // esta linea encripta las contraseñas
            'password' => $request['password'],
        ]);

        $role = Role::find($request['role_id']);
        $user->assignRole($role);

        return redirect('/usuarios')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('usuarios.index', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('usuarios.edit', compact('user', 'roles'));
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
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('username', $request->username);
                })
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'], // asegura que cada role exista en la tabla roles
        ]);

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));

        $roles = Role::whereIn('id', $request->input('roles', []))->get();
        $user->syncRoles($roles);

        $user->save();

        return redirect('/usuarios')->with('success', 'Usuario actualizado correctamente');
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
        $user->delete();
        return redirect('/usuarios');
    }
}
