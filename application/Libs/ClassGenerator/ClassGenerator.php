<?php
/**
 * Created by PhpStorm.
 * User: gabriel.malaquias
 * Date: 30/12/2014
 * Time: 14:55
 */

namespace Libs\ClassGenerator;


use Libs\ClassGenerator\Template\Template;
use Libs\Database;
use Libs\StringHelper;


class ClassGenerator
{

    private $fields = array();

    private $verify = array();

    private $db;

    var $pasta;

    public function __construct($Pasta = "GDM"){
        $this->pasta = $Pasta;
    }

    public function run()
    {
        $this->db = new Database();

        if (!is_dir(APP . 'DAL' . DIRECTORY_SEPARATOR . 'Generator' . DIRECTORY_SEPARATOR . $this->pasta))
            @mkdir(APP . 'DAL' . DIRECTORY_SEPARATOR . 'Generator' . DIRECTORY_SEPARATOR . $this->pasta);

        $this->getTables();
    }

    private function getTables()
    {
        //Consulta as tabelas
        $tables = $this->db->Select("SELECT TABLE_NAME AS Name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . DB_PREFIX . $this->pasta . "'", '', true);

        if (is_array($tables)):
            foreach ($tables as $table):
                $this->getFields($table->Name);
            endforeach;
        endif;
    }

    private function getFields($table)
    {
        $fields = $this->db->Select("SHOW COLUMNS FROM " . $table, '', true);

        $this->fields = array();
        $this->verify = array();

        foreach ($fields as $field):
            $this->fields[] = array($field->Field, $table);
            $this->verify[] = $field->Field;
        endforeach;

        $this->getVirtual($table);
        $this->generateClass($table);
    }

    private function getVirtual($table)
    {
        #region .: Query de busca virtuais :.
        $consulta = "SELECT column_name            AS NomeColuna, ";
        $consulta .= "       constraint_name        AS Tipo, ";
        $consulta .= "       referenced_column_name AS CampoReferencia, ";
        $consulta .= "       referenced_table_name  AS TabelaReferencia ";
        $consulta .= "FROM   information_schema.key_column_usage ";
        $consulta .= "WHERE  table_name = '$table' ";
        $consulta .= "AND TABLE_SCHEMA = '" . DB_PREFIX . $this->pasta . "'";
        #endregion

        $fields = $this->db->Select($consulta, '', true);

        if(is_array($fields) || is_object($fields)) {
            foreach ($fields as $field):
                //Marca a Primary Key
                if ($field->Tipo == "PRIMARY") {
                    $k = array_search($field->NomeColuna, $this->fields);
                    $this->fields[$k][] = "PRIMARY";
                } else {
                    //Pega as relações
                    $table = $field->TabelaReferencia;
                    $i = 1;
                    //verifica o nome

                    $tabelatmp = $table;
                    while (in_array($table, $this->verify)) {
                        $table = $tabelatmp . $i;
                        $i++;
                    }
                    $this->verify[] = $table;
                    $this->fields[] = array($table, $field->NomeColuna, $field->TabelaReferencia);
                }
            endforeach;
        }
    }

    private function generateConstruct(){

        $retorno = new \stdClass();
        $i = 0;
        $retorno->parametros = "";
        $retorno->conteudo =
            "\n".'
            $unitofwork = new UnitofWork();'.
            "\n".'
            if(!empty($'.$this->fields[1][0].')){
            ';
        foreach ($this->fields as $l) :
            $retorno->parametros .=  '$'.$l[0].' = ""' . ($i < (count($this->fields)-1) ? "," : "");
            $retorno->conteudo .= "\n".'  $this->'.$l[0].' = $'.$l[0].';';
            $i++;
        endforeach;
        $retorno->conteudo .= "\n".'
        }
        '."\n".' if(!empty($this->'.$this->fields[0][0].')){
        '."\n".'      //Virtuais e Referencias
        '."\n".'
        '."\n".' }
        ';
        //var_dump($this->fields);
        return $retorno;
    }

    private function generateClass($table)
    {
        $vars = "";
        foreach ($this->fields as $l) :
            $type = null;

            if (count($l) == 2) {
                //pegaTipo
                $consulta = "SHOW FIELDS FROM " . $l[1] . " where Field ='" . $l[0] . "'";
                $busca = $this->db->Select($consulta);
                $type = $busca->Type;

                $vars .= "\n/**
                 * @Name: " . $l[0] . "
                 * @DisplayName: " . $l[0] . "
                 * @Type: " . $type . "
                 */";

               if ($type == 'tinyint(1)')
                    $vars .= "\n var $" . $l[0] . " = 0;\n";
                else if (StringHelper::Contains($type, 'int'))
                    $vars .= "\n var $" . $l[0] . " = 0;\n";
                else
                    $vars .= "\n var $" . $l[0] . ";\n";

            } else {
                if ($l[2] == "PRIMARY") {

                    $consulta = "SHOW FIELDS FROM " . $l[1] . " where Field ='" . $l[0] . "'";
                    $busca = $this->db->Select($consulta);
                    $type = $busca->Type;

                    $vars .= "/**
                     * @PrimaryKey
                     * @Name: " . $l[0] . "
                     * @DisplayName: " . $l[0] . "
                     * @Type: " . $type . "
                     */";
                    $vars .= "\n var \$" . $l[0] . " = 0;\n";

                } else {
                    if ($l[0] != '') {
                        $vars .= "\n/**
                         * @NotMapped
                         * @Virtual
                         * @Name: _" . ucfirst($l[0]) . "
                         * @DisplayName: _" . ucfirst($l[0]) . "
                         * @Fk: " . $l[1] . "
                         * @Type: " . ucfirst($l[2]) . "
                         */";
                        $vars .= "\n var \$_" . ucfirst($l[0]) . ";\n";
                    }
                }
            }
        endforeach;

        $construct = $this->generateConstruct();
        var_dump($construct);

        $namespace = "DAL";
        if(!empty($this->pasta) && $this->pasta != "GDM"){
            $namespace .= "\\".$this->pasta;
        }

        $template = new Template(APP . 'Libs' . DIRECTORY_SEPARATOR . "ClassGenerator" . DIRECTORY_SEPARATOR . "Template" . DIRECTORY_SEPARATOR . "ClasseTemplate.tpl");
        $template->set('NameSpace', $namespace);
        $template->set('date', date("d/m/Y H:i:s"));
        $template->set('C', ucfirst($table));
        $template->set('vars', $vars);
        $template->set('construct_parametros', $construct->parametros);
        $template->set('construct_conteudo', $construct->conteudo);
        $template->write(APP . 'DAL' . DIRECTORY_SEPARATOR . 'Generator' . DIRECTORY_SEPARATOR . $this->pasta . DIRECTORY_SEPARATOR  . ucfirst($table) . '.php');
    }

} 