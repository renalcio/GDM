<?
/**
 * Model
 * Titulo: Artista
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 */
namespace Model;
use Classe\Database;
use DAL\Artista;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class ArtistaModel
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

    public function GetToEdit(Artista $model)
    {
        if($model->ArtistaId > 0)
        {
            $model = $this->pdo->GetById("Artista", "ArtistaId", $model->ArtistaId, "DAL\\Artista");
        }else{
            $model = new Artista();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->pdo->select("SELECT * FROM Artista", "DAL\\Artista", true);

        return $model;
    }

    public function Save(Artista $model){

        if($model!=null) {
            $this->md5 = md5(strtolower($this->Titulo));
            if ($model->ArtistaId > 0){
                $this->pdo->update("Artista", $model, "ArtistaId = " . $model->ArtistaId);
            } else {
                $model->ArtistaId = $this->pdo->insert("Artista", $model);
            }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Artista", "ArtistaId = '".$id."'");
        }
    }

    public function Validar(Artista $model)
    {

    }
}
