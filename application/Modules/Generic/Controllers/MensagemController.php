<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 13/04/2015
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use DAL\Mensagem;
use DAL\MensagemPessoa;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Mensagens
 *
 */
class MensagemController extends Controller
{
	/**
	 *
	 * @Title: Caixa de Entrada
	 *
	 */
    public function index()
    {
        $this->AddAsset(["iCheck"]);
        $this->loadBLL();
        $Model = new \stdClass();
        $this->ModelView($Model);
    }

	/**
	 *
	 * @Title: Nova Mensagem
	 *
	 */
    public function escrever()
    {
        $this->AddAsset(["bootstrap-markdown"]);
        // load views
        $this->loadBLL();
        $Model = new Mensagem();
        //var_dump($_POST);
        $this->ModelView($Model);

    }

    /**
     *
     * @Title: Nova Mensagem
     *
     */
    public function responder($RespostaId = 0, $Encaminhamento = 0)
    {
        $this->AddAsset(["bootstrap-markdown"]);
        // load views
        $Origem = new MensagemPessoa();
        $Origem = $this->unitofwork->GetById(new MensagemPessoa(), $RespostaId);

        $this->loadBLL();
        $Model = new Mensagem();
        $Model->Para = ($Encaminhamento <= 0) ? $Origem->Mensagem->PessoaId : "";
        $Model->Assunto = (($Encaminhamento <= 0) ? "Re: " : "En: ").$Origem->Mensagem->Assunto;
        $Model->Conteudo = "<br><hr><i>Mensagem de ".$Origem->Mensagem->Pessoa->Nome." - ".date("d/m/Y - H:i:s", $Origem->Mensagem->DataEnvio)."<br>Assunto: ".$Origem->Mensagem->Assunto."</i><br><br>".$Origem->Mensagem->Conteudo;
        $Model->RespostaId = ($Encaminhamento > 0) ? 0 : $RespostaId;
        $Model->Encaminhamento = $Encaminhamento;
        //var_dump($_POST);
        $this->ModelView($Model,"escrever");

    }
    public function responder_post($model = null){
        $this->escrever_post($model);
    }

    public function escrever_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Mensagem);
            $this->loadBLL();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    $this->bll->Enviar($model); // Salva
                    $this->Redirect("Index"); // Redireciona pra index do controller
                }
            }
        }else{
            $model = new \stdClass();
        }

        $this->ModelView($model);
    }

    /**
     *
     * @Title: Nova Mensagem
     *
     */
    public function ler($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new MensagemPessoa();
        $Model->MensagemPessoaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->Layout("", "");
        $this->ModelView($Model);

    }

    public function deletar($id = 0){
        $this->loadBLL();
        if(isset($_POST["DeleteItems"]) && !empty($_POST["DeleteItems"]) && is_array($_POST["DeleteItems"])) {
            foreach($_POST["DeleteItems"] as $item){
                $this->bll->Deletar($item);
            }
        }else if(!empty($id)){
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}