<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GamesController
{

    protected $gamesService;

    public function __construct($service)
    {
        $this->gamesService = $service;
    }

    public function getAll()
    {
        return new JsonResponse($this->gamesService->getAll());
    }

    public function getGameById($id)
    {
        return new JsonResponse($this->gamesService->getGameById($id));
    }

    public function save(Request $request)
    {
        
        $game = $this->getDataFromRequest($request);        
        return new JsonResponse(array("status" => $this->gamesService->save($game)));

    }

    public function update($id, Request $request)
    {
        $note = $this->getDataFromRequest($request);
        $this->notesService->update($id, $note);
        return new JsonResponse($note);

    }

    public function delete($id)
    {

        return new JsonResponse($this->notesService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return $game = array(
            "id" => $request->request->get("id"),
            "name" => $request->request->get("name")
        );
    }
}
