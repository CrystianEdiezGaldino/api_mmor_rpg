<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|exists:accounts,login',
            'char_name' => 'required|string|unique:characters,char_name',
            'race' => 'required|integer|min:0|max:5',
            'classid' => 'required|integer|min:0|max:136',
            'sex' => 'required|integer|min:0|max:1',
            'face' => 'required|integer|min:0|max:3',
            'hairStyle' => 'required|integer|min:0|max:4',
            'hairColor' => 'required|integer|min:0|max:3',
            'x' => 'required|integer',
            'y' => 'required|integer',
            'z' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $character = new Character();
            $character->account_name = $request->account_name;
            $character->char_name = $request->char_name;
            $character->level = 1;
            $character->maxHp = 100;
            $character->curHp = 100;
            $character->maxCp = 0;
            $character->curCp = 0;
            $character->maxMp = 100;
            $character->curMp = 100;
            $character->face = $request->face;
            $character->hairStyle = $request->hairStyle;
            $character->hairColor = $request->hairColor;
            $character->sex = $request->sex;
            $character->heading = 0;
            $character->x = $request->x;
            $character->y = $request->y;
            $character->z = $request->z;
            $character->exp = 0;
            $character->expBeforeDeath = 0;
            $character->sp = 0;
            $character->karma = 0;
            $character->pvpkills = 0;
            $character->pkkills = 0;
            $character->clanid = 0;
            $character->race = $request->race;
            $character->classid = $request->classid;
            $character->base_class = $request->classid;
            $character->deletetime = 0;
            $character->cancraft = 0;
            $character->title = '';
            $character->rec_have = 0;
            $character->rec_left = 0;
            $character->accesslevel = 0;
            $character->online = 0;
            $character->onlinetime = 0;
            $character->lastAccess = 0;
            $character->clan_privs = 0;
            $character->wantspeace = 0;
            $character->isin7sdungeon = 0;
            $character->punish_level = 0;
            $character->punish_timer = 0;
            $character->power_grade = 0;
            $character->nobless = 0;
            $character->hero = 0;
            $character->subpledge = 0;
            $character->lvl_joined_academy = 0;
            $character->apprentice = 0;
            $character->sponsor = 0;
            $character->varka_ketra_ally = 0;
            $character->clan_join_expiry_time = 0;
            $character->clan_create_expiry_time = 0;
            $character->death_penalty_level = 0;
            $character->pc_point = 0;
            $character->save();

            return response()->json([
                'success' => true,
                'message' => 'Personagem criado com sucesso',
                'data' => $character
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar personagem',
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
        try {
            $character = Character::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $character
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Personagem não encontrado'
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

    public function listByAccount($accountName)
    {
        try {
            $characters = Character::where('account_name', $accountName)->get();
            return response()->json([
                'success' => true,
                'message' => 'Personagens encontrados',
                'data' => $characters
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar personagens',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
