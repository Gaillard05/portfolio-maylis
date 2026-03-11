<?php

class DownloadCv {

    public function download()  {
        // environnement de dev
        $file = __DIR__ . '\..\..\public\assets\cv\cv_maylis_gaillard.pdf';
        // environnement de prod
        // $file = __DIR__ . '/../../public/assets/cv/cv_maylis_gaillard.pdf';

        if(file_exists($file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . filesize($file));

            $chunkSize = 1024 * 1024;
            $handle = fopen($file, "rb");

            if($handle === false) {
                http_response_code(403);
                require '../app/views/erreurs/403.phtml';
            }

            while(!feof($handle)) {
                echo fread($handle, $chunkSize);
                flush();
            }

            fclose($handle);
            header('location: /');
            exit;
        } else {
            http_response_code(404);
            require '../app/views/erreurs/404.phtml';
            // echo "fichier non trouvé";
        }

        
    }
        
}