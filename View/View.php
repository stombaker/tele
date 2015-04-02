<?php
namespace View;

use Exception;

class View {
    private $file;

    public function __construct($folderName, $fileName) {
        $this->file = './View/' . $folderName . '/' . $fileName . 'View.php';
    }

    private function generateFile($file, $data) {
        if (file_exists($file)) {
            if (isset($data)) {
                extract($data);
                ob_start();
                require $file;
                return ob_get_clean();
            }
        } else {
            throw new Exception($file . ' does not exists.');
        }
    }

    public function create($data) {
        $content = $this->generateFile($this->file, $data);
        $view = $this->generateFile(__DIR__ . '/layout.php', ['content' => $content]);
        return $view;
    }
}