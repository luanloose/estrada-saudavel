<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Api\ApiMessages as Msg;

class PointsController extends Controller
{
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function deposit(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'amount' => 'required'

        ]);

        try {
            $data = $request->all();
            $amount = $data['amount'];
            $name = $data['user'];

            $user = $this->user->with(['health', 'game'])
                ->where('name', 'like', "%{$name}%")->get();

            $user->update(['points' => $user->points + $amount]);

            return response()->json(
                Msg::getSucess("Deposito de pontos realizados com sucesso"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no deposito de pontos, contate o administrador"),
                500
            );
        }
    }

    public function withdraw(Request $request)
    {
        try {
            $data = $request->all();

            $user = $this->user->with(['health', 'game'])
                ->where('name', 'like', "%{$data['user']}%")->get();

            if ($user == null) {
                return response()->json(
                    Msg::getError("Usuário nao encontrado"),
                    404
                );
            }

            if ($user->points <= 0 || $user->points > floatval($data['amount'])) {

                return response()->json(
                    Msg::getError("Voce nao tem saldo suficiente para saque"),
                    401
                );
            }

            $user->update(['points' => $user->points - $data['amount']]);

            return response()->json(
                Msg::getSucess("Saque realizado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no saque, contate o administrador"),
                500
            );
        }
    }
}
