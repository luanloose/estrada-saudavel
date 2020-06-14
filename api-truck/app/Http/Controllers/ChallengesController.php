<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Games;
use App\Api\ApiMessages as Msg;
use App\Challenges;

class ChallengesController extends Controller
{
    private $game;
    private $challenge;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Games $game, Challenges $challenge)
    {
        $this->game = $game;
        $this->challenge = $challenge;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'points' => 'required'
        ]);

        $data = $request->all();

        try {

            $id = $data['game'];

            $game = $this->game->findOrFail($id);

            $game->challenge()->create($data['challenge']);

            return response()->json(
                Msg::getSucess("Desafio cadastrado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro do desafio, contate o administrador"),
                500
            );
        }
    }
    public function finish(Request $request)
    {
        $this->validate($request, [
            'finish' => 'required'
        ]);

        $data = $request->all();

        try {

            $id = $data['challenge'];
            $amount = $data['amount'];

            $challenge = $this->challenge->findOrFail($id);

            if ($data['challenge'] == true) {
                $challenge->update(['points' => $amount]);
            } else if ($data['challenge'] == false) {
                $challenge->update(['points' => 0]);
            }

            return response()->json(
                Msg::getSucess("Desafio finalizado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no finalizar do desafio, contate o administrador"),
                500
            );
        }
    }
}
