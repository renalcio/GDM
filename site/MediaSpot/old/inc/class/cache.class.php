<?php
 
/**
 * Sistema de cache
 *
 * @author Thiago Belem <contato@thiagobelem.net>
 * @link http://blog.thiagobelem.net/
 */
class Cache {
 
        /**
         * Tempo padr�o de cache
         *
         * @var string
         */
        private static $time = '10 minutes';
       
        /**
         * Local onde o cache ser� salvo
         *
         * Definido pelo construtor
         *
         * @var string
         */
        private $folder;
 
        /**
         * Construtor
         *
         * Inicializa a classe e permite a defini��o de onde os arquivos
         * ser�o salvos. Se o par�metro $folder for ignorado o local dos
         * arquivos tempor�rios do sistema operacional ser� usado
         *
         * @uses Cache::setFolder() Para definir o local dos arquivos de cache
         *
         * @param string $folder Local para salvar os arquivos de cache (opcional)
         *
         * @return void
         */
        public function __construct($folder = null) {
                $this->setFolder(!is_null($folder) ? $folder : sys_get_temp_dir());
        }
       
        /**
         * Define onde os arquivos de cache ser�o salvos
         *
         * Ir� verificar se a pasta existe e pode ser escrita, caso contr�rio
         * uma mensagem de erro ser� exibida
         *
         * @param string $folder Local para salvar os arquivos de cache (opcional)
         *
         * @return void
         */
        protected function setFolder($folder) {
                // Se a pasta existir, for uma pasta e puder ser escrita
                if (file_exists($folder) && is_dir($folder) && is_writable($folder)) {
                        $this->folder = $folder;
                } else {
                        trigger_error('N�o foi poss�vel acessar a pasta de cache', E_USER_ERROR);
                }
        }
       
        /**
         * Gera o local do arquivo de cache baseado na chave passada
         *
         * @param string $key Uma chave para identificar o arquivo
         *
         * @return string Local do arquivo de cache
         */
        protected function generateFileLocation($key) {
                return $this->folder . DIRECTORY_SEPARATOR . sha1($key) . '.tmp';
        }
       
        /**
         * Cria um arquivo de cache
         *
         * @uses Cache::generateFileLocation() para gerar o local do arquivo de cache
         *
         * @param string $key Uma chave para identificar o arquivo
         * @param string $content Conte�do do arquivo de cache
         *
         * @return boolean Se o arquivo foi criado
         */
        protected function createCacheFile($key, $content) {
                // Gera o nome do arquivo
                $filename = $this->generateFileLocation($key);
               
                // Cria o arquivo com o conte�do
                return file_put_contents($filename, $content)
                        OR trigger_error('N�o foi poss�vel criar o arquivo de cache', E_USER_ERROR);
        }
       
        /**
         * Salva um valor no cache
         *
         * @uses Cache::createCacheFile() para criar o arquivo com o cache
         *
         * @param string $key Uma chave para identificar o valor cacheado
         * @param mixed $content Conte�do/vari�vel a ser salvo(a) no cache
         * @param string $time Quanto tempo at� o cache expirar (opcional)
         *
         * @return boolean Se o cache foi salvo
         */
        public function salvar($key, $content, $time = null) {
                $time = strtotime(!is_null($time) ? $time : self::$time);
                       
                $content = serialize(array(
                        'expires' => $time,
                        'content' => $content));
               
                return $this->createCacheFile($key, $content);
        }
       
       
        /**
         * Salva um valor do cache
         *
         * @uses Cache::generateFileLocation() para gerar o local do arquivo de cache
         *
         * @param string $key Uma chave para identificar o valor cacheado
         *
         * @return mixed Se o cache foi encontrado retorna o seu valor, caso contr�rio retorna NULL
         */
        public function ler($key) {
                $filename = $this->generateFileLocation($key);
                if (file_exists($filename) && is_readable($filename)) {
                        $cache = unserialize(file_get_contents($filename));
                        if ($cache['expires'] > time()) {
                                return $cache['content'];
                        } else {
                                unlink($filename);
                        }
                }
                return null;
        }
}
 
?>