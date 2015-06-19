<?php

namespace App\Services;

class GamesService extends BaseService
{

    function getAll()
    {
        $query = $this->db->prepare('EXECUTE [dbo].[getAllGames]');
        $query->execute();              
        while($row = $query->fetch())
        {
            $value[] = $row;        
        }
        if(!isset($value))
        {
            $value['error'] = 1;
            $value['mensage'] = 'Erro ao execultar a procedure';
        }
        return $value;
    }

    function save($game)
    {
        $this->db->insert("game", $game);        
        return 'sucess';
    }

    function getGameById($id)
    {
        $query = $this->db->prepare('EXECUTE [dbo].[getGameById] @ID = ?');
        $query->bindValue(1, $id);
        $query->execute();              
        while($row = $query->fetch())
        {
            $value[] = $row;        
        }        
        if(!isset($value))
        {
            $value['error'] = 2;
            $value['mensage'] = 'Registro não encontrado';
        }
        return $value;
    }

    function update($id, $game)
    {
        return $this->db->update('game', $game, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("notes", array("id" => $id));
    }

    function getLastId()
    {
        $query = $this->db->prepare('SELECT IDENT_CURRENT("game")');
        $query->execute(); 
        return $query->fetch();
    }

}
