<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * create a new controller instance
     *
     * @return voidagre
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', ['only' => 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    }
    */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 'recepcion' || auth()->user()->role == 'user') {
                abort(403);
            }
            return $next($request);
        });
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('usuarios.index')->with('users', $users);
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
            ],
            'role' => ['required', 'string', 'in:admin,recepcion,user'],
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            //'password' => Hash::make($request['password']), // esta linea encripta las contraseñas
            'password' => $request['password'],
            'role' => $request['role'],
        ]);

        return redirect('/usuarios');
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
        return view('usuarios.edit')->with('user', $user);
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
        return view('usuarios.edit')->with('user', $user);
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
            'role' => ['required', 'string', 'in:admin,recepcion,user'],
        ]);

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->role = $request->get('role');
        $user->password = Hash::make($request->get('password'));

        $user->save();

        return redirect('/usuarios');
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
