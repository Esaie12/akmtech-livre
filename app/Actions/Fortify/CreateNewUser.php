<?php

namespace App\Actions\Fortify;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Souscription;
use App\Models\Invitation;
use App\Models\Notif;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input,[
            'invitation'=>['numeric', 'required', 'min:0', 'max:1'],
        ]);

        if($input['invitation'] == 0){

            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'prenoms'=>['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
               /* 'password' =>['required' , 'string',
                    Password::min(8)->letters()->mixedCase()->numbers()->symbols()
                ],*/

            ])->validate();

            $de = explode('@',$input['email']);

            $us = new User();
            $us->name = $input['name'];
            $us->prenoms = $input['prenoms'];
            $us->email = $input['email'];
            $us->code_invitation = $de[0]."_inpl";
            $us->password = Hash::make($input['password']) ;
            $us->save();

        }elseif($input['invitation'] == 1){

            Validator::make($input, [
                'idInvite'=>['required', 'numeric', 'min:1'],
                'name' => ['required', 'string', 'max:255'],
                'prenoms'=>['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                //'password' => $this->passwordRules(),
                'password' =>['required' , 'string', 'min:8'
                    //Password::min(8)->letters()->mixedCase()->numbers()->symbols()
                ],

            ])->validate();

            $de = explode('@',$input['email']);

            $us = new User();
            $us->invite_by = $input['idInvite'];
            $us->invite = 1;
            $us->name = $input['name'];
            $us->prenoms = $input['prenoms'];
            $us->email = $input['email'];
            $us->code_invitation = $de[0]."_inpl";
            $us->password = Hash::make($input['password']) ;
            $us->save();

            $n = new Invitation();
            $n->idUser = $us->id;
            $n->inviteBy = $input['idInvite'];
            $n->dateInscription = date('Y-m-d');
            $n->save();

            /*
            $g = User::find($input['idInvite']);
            $g->solde = $g->solde +50;
            $g->save();
            */

            //LEs notifications
            $noti = new Notif();
            $noti->idUser_from = $input['idInvite'];
            $noti->message = $input['name']." ".$input['prenoms']." que vous
                avez inviter, viens de s'inscrire. Vous percevrez 50 Fcfa après son premier abonnement";
            $noti->date_receve = date('Y-m-d');
            $noti->save();

            $us2 = User::find($input['idInvite']);
            $us2->solde_off = $us2->solde_off + 50;
            $us2->save();


        }


        /*$su = new Souscription();
        $su->idUser = $us->id;
        $su->idPack = 5;
        $su->description = "Essai de 5 Jours";
        $su->dateStart = date('Y-m-d');
        $su->dateEnd = date('Y-m-d', strtotime("+5 days")) ;
        $su->save();*/

        $su = new Souscription();
        $su->idUser = $us->id;
        $su->idPack = 0;
        $su->description = "Abonnement de type gratuit";
        $su->dateStart = date('Y-m-d');
        $su->dateEnd = Null;
        $su->idTransaction = "free_Transaction";
        $su->save();

        return User::find($us->id);
    }
}
