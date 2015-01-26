<?php
/**
 * Model
 * Titulo: Musica
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace Model;
use Classe\Database;
use DAL\Musica;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class musicaModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->pdo = new Database;
    }

    public function GetToEdit(Musica $model)
    {
        if($model->UsuarioAplicacaoId > 0)
        {
            $model = $this->pdo->GetById("Musica", "MusicaId", $model->MusicaId, "DAL\\Musica");
        }else{
            $model = new Musica();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->pdo->select("SELECT Musica WHERE ", "DAL\\Musica", true);

        return $model;
    }

    public function Save(Musica $model){

        if($model!=null) {

                if ($model->MusicaId > 0){

                    $this->pdo->update("Musica", $model, "MusicaId = " . $model->MusicaId);
                } else {
                    $model->MusicaId = $this->pdo->insert("Musica", $model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Musica", "MusicaId = '".$id."'");
        }
    }

    public function Validar(Musica $model)
    {

    }
}
