<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Games;
use App\Api\ApiMessages as Msg;

class GamesController extends Controller
{
    private $user;
    private $game;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Games $game)
    {
        $this->user = $user;
        $this->game = $game;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'km_route' => 'required',
        ]);

        $data = $request->all();

        try {

            $id = $data['user'];

            $user = $this->user->findOrFail($id);

            $user->game()->create($data['game']);

            return response()->json(
                Msg::getSucess("Game cadastrado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro do game, contate o administrador"),
                500
            );
        }
    }

    public function update($user, Request $request)
    {
        $data = $request->all();

        try {

            $user = $this->user->findOrFail($user);

            $user->game()->update($data['game']);

            return response()->json(
                Msg::getSucess("Game atualizado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na atualização do game, contate o administrador"),
                500
            );
        }
    }

    public function destroy($user)
    {
        $user = $this->user->find($user);

        $user->health()->delete();

        return response()->json(
            Msg::getSucess("Ficha removida com sucesso!"),
            200
        );
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $data = $request->all();

        try {

            $id = $data['game'];

            $game = $this->game->findOrFail($id);

            $game = $this->user->with(['challenges'])
                ->where('id', '=', "%{$id}%")->get();

            $challenges = $game['challenges'];

            $points = 0;

            foreach ($challenges as $challenge) {
                $points += $challenge['points'];
            }

            $this->game->update(['points' => $points]);

            return response()->json(
                ['Game' => $this->game],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro do game, contate o administrador"),
                500
            );
        }
    }
}
