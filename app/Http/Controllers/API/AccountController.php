<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $accounts = Account::select('login')->get();
            return response()->json([
                'status' => 'success',
                'data' => $accounts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao listar contas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:45|unique:accounts',
            'password' => 'required|string|max:45',
            'access_level' => 'integer',
            'lastServer' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $account = Account::create([
                'login' => $request->login,
                'password' => md5($request->password),
                'lastactive' => time(),
                'access_level' => $request->access_level ?? 0,
                'lastServer' => $request->lastServer ?? 1
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Conta criada com sucesso',
                'data' => $account
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar conta',
                'error' => $e->getMessage()
            ], 500);
        }
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
        //
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

    public function checkEndpoint()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Endpoint de login está funcionando! Use POST para fazer login.'
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:45',
            'password' => 'required|string|max:45'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $account = Account::where('login', $request->login)
                            ->where('password', md5($request->password))
                            ->first();

            if (!$account) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Login ou senha inválidos'
                ], 401);
            }

            // Atualiza o lastactive
            $account->update(['lastactive' => time()]);

            // Revoga tokens antigos
            AuthToken::where('account_name', $account->login)
                    ->where('is_revoked', false)
                    ->update(['is_revoked' => true]);

            // Gera novo token
            $token = Str::random(64);
            $expiresAt = Carbon::now()->addDays(7); // Token válido por 7 dias

            AuthToken::create([
                'account_name' => $account->login,
                'token' => $token,
                'expires_at' => $expiresAt
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login realizado com sucesso',
                'data' => $account,
                'token' => $token,
                'expires_at' => $expiresAt->toIso8601String()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao realizar login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->bearerToken();
            
            if ($token) {
                AuthToken::where('token', $token)
                        ->update(['is_revoked' => true]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Logout realizado com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao realizar logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
