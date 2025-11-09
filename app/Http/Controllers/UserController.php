<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar usuários com a respectiva role carregada
    public function index()
    {
        $users = User::with('role')->simplePaginate(10); // Mostra só Previous e Next
        return view('users.index', compact('users'));
    }


    // Mostrar formulário para criar usuário
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Armazenar novo usuário
    public function store(Request $request)
    {
        $data = $request->validate([
            'role_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'nullable|string|max:14',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|string',
            'digital_certificate' => 'nullable|string',
            'certificate_serial' => 'nullable|string',
            'certificate_valid_from' => 'nullable|date',
            'certificate_valid_until' => 'nullable|date',
            'certificate_issuer' => 'nullable|string',
            'is_active' => 'boolean',
            'last_login_at' => 'nullable|date',
            'last_login_ip' => 'nullable|string',
            'failed_login_attempts' => 'nullable|integer',
            'locked_until' => 'nullable|date',
            'locale' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:50',
            'theme' => 'nullable|string|max:50',
            'email_notifications' => 'boolean',
            'notification_preferences' => 'nullable|json',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    // Mostrar formulário para editar usuário
    public function edit(User $user)
    {
         $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Atualizar usuário
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'cpf' => 'nullable|string|max:14',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|string',
            'digital_certificate' => 'nullable|string',
            'certificate_serial' => 'nullable|string',
            'certificate_valid_from' => 'nullable|date',
            'certificate_valid_until' => 'nullable|date',
            'certificate_issuer' => 'nullable|string',
            'is_active' => 'boolean',
            'last_login_at' => 'nullable|date',
            'last_login_ip' => 'nullable|string',
            'failed_login_attempts' => 'nullable|integer',
            'locked_until' => 'nullable|date',
            'locale' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:50',
            'theme' => 'nullable|string|max:50',
            'email_notifications' => 'boolean',
            'notification_preferences' => 'nullable|json',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Deletar usuário
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
