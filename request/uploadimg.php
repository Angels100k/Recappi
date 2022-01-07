<?php
$endname = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path =  '../assets/img/';
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];

        $all_files = count($_FILES['files']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $lastDot = strrpos($file_name, ".");
            $new_file_name = str_replace(" ", "", substr($file_name, 0, $lastDot)) . substr($file_name, $lastDot);
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
            $tempname = explode('.', $_FILES['files']['name'][$i]);
            $file_ext = end($tempname);
            $file_newname = explode('.', $_FILES['files']['name'][$i]);
            $file_currentname = $file_newname[0] . "_".str_replace(".", "_", microtime(true))."." . substr($file_name, strrpos($file_name, '.') + 1);
            $endname = $file_currentname;
            $file = $path . $file_currentname;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $new_file_name . ' ' . $file_type;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $new_file_name . ' ' . $file_type;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
            }
        }

        if ($errors){
            echo"custom error: ";
            print_r($errors);
        } else {
            echo json_encode(($endname));
        }
    }
}