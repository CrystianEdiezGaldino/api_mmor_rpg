<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';
    protected $primaryKey = 'obj_Id';
    public $timestamps = false;

    protected $fillable = [
        'account_name',
        'char_name',
        'level',
        'maxHp',
        'curHp',
        'maxCp',
        'curCp',
        'maxMp',
        'curMp',
        'face',
        'hairStyle',
        'hairColor',
        'sex',
        'heading',
        'x',
        'y',
        'z',
        'exp',
        'expBeforeDeath',
        'sp',
        'karma',
        'pvpkills',
        'pkkills',
        'clanid',
        'race',
        'classid',
        'base_class',
        'deletetime',
        'cancraft',
        'title',
        'rec_have',
        'rec_left',
        'accesslevel',
        'online',
        'onlinetime',
        'lastAccess',
        'clan_privs',
        'wantspeace',
        'isin7sdungeon',
        'punish_level',
        'punish_timer',
        'power_grade',
        'nobless',
        'hero',
        'subpledge',
        'lvl_joined_academy',
        'apprentice',
        'sponsor',
        'varka_ketra_ally',
        'clan_join_expiry_time',
        'clan_create_expiry_time',
        'death_penalty_level',
        'pc_point'
    ];

    protected $casts = [
        'obj_Id' => 'integer',
        'level' => 'integer',
        'maxHp' => 'integer',
        'curHp' => 'integer',
        'maxCp' => 'integer',
        'curCp' => 'integer',
        'maxMp' => 'integer',
        'curMp' => 'integer',
        'face' => 'integer',
        'hairStyle' => 'integer',
        'hairColor' => 'integer',
        'sex' => 'integer',
        'heading' => 'integer',
        'x' => 'integer',
        'y' => 'integer',
        'z' => 'integer',
        'exp' => 'integer',
        'expBeforeDeath' => 'integer',
        'sp' => 'integer',
        'karma' => 'integer',
        'pvpkills' => 'integer',
        'pkkills' => 'integer',
        'clanid' => 'integer',
        'race' => 'integer',
        'classid' => 'integer',
        'base_class' => 'integer',
        'deletetime' => 'integer',
        'cancraft' => 'integer',
        'rec_have' => 'integer',
        'rec_left' => 'integer',
        'accesslevel' => 'integer',
        'online' => 'integer',
        'onlinetime' => 'integer',
        'lastAccess' => 'integer',
        'clan_privs' => 'integer',
        'wantspeace' => 'integer',
        'isin7sdungeon' => 'integer',
        'punish_level' => 'integer',
        'punish_timer' => 'integer',
        'power_grade' => 'integer',
        'nobless' => 'integer',
        'hero' => 'integer',
        'subpledge' => 'integer',
        'lvl_joined_academy' => 'integer',
        'apprentice' => 'integer',
        'sponsor' => 'integer',
        'varka_ketra_ally' => 'integer',
        'clan_join_expiry_time' => 'integer',
        'clan_create_expiry_time' => 'integer',
        'death_penalty_level' => 'integer',
        'pc_point' => 'integer'
    ];

    protected $nullable = [
        'deletetime',
        'cancraft',
        'online',
        'onlinetime',
        'lastAccess',
        'wantspeace',
        'power_grade',
        'pc_point'
    ];
}
