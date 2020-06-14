<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Api\ApiMessages as Msg;

class HealthController extends Controller
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'height' => 'required',
            'weight' => 'required',
            'is_smoker' => 'required',
            'has_diabetes' => 'required',
            'has_hypertension' => 'required'
        ]);

        $data = $request->all();

        try {

            $name = $data['user'];

            $user = $this->user->with(['health', 'game'])
                ->where('name', 'like', "%{$name}%")->get();

            $user->health()->create($data['health']);

            return response()->json(
                Msg::getSucess("Ficha médica cadastrada com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro da ficha medica, contate o administrador"),
                500
            );
        }
    }

    public function update($user, Request $request)
    {
        $data = $request->all();

        try {

            $user = $this->user->findOrFail($user);

            $user->health()->update($data['health']);

            return response()->json(
                Msg::getSucess("Ficha atualizada com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na atualização, contate o administrador"),
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
}
