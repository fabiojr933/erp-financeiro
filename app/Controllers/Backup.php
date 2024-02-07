<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use Ifsnop\Mysqldump as IMysqldump;


class Backup extends Controller
{

    private $dbUsuario;
    private $session;

    public function __construct() {
        $this->dbUsuario = new UsuarioModel();
        $this->session = session(); 
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('backup/index');
        echo View('templates/footer');
    }

    public function backup()
    {
        try {

            $hostname = '127.0.0.1';
            $database = 'erp_financeiro';
            $username = 'root';
            $password = '';

            $dsn = 'mysql:host=' . $hostname . ';dbname=' . $database;

            // Nome do arquivo de backup
            $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

            // Caminho completo do arquivo de backup
            $backupFilePath =  WRITEPATH . 'uploads/' . $backupFileName;

            // Criação do objeto Mysqldump
            $dump = new IMysqldump\Mysqldump($dsn, $username, $password);

            // Geração do backup e gravação no arquivo
            $dump->start($backupFilePath);

            // Cabeçalhos para forçar o download do arquivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $backupFileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backupFilePath));

            // Leitura e saída do conteúdo do arquivo de backup
            readfile($backupFilePath);

            // Excluindo o arquivo de backup após o download
            unlink($backupFilePath);

            exit;
        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
        }
    }
}
