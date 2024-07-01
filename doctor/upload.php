<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdf']['tmp_name'];
        $fileName = $_FILES['pdf']['name'];
        $fileSize = $_FILES['pdf']['size'];
        $fileType = $_FILES['pdf']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('pdf');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $response = array('success' => true, 'url' => $dest_path);
            } else {
                $response = array('success' => false, 'message' => 'There was an error moving the uploaded file.');
            }
        } else {
            $response = array('success' => false, 'message' => 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions));
        }
    } else {
        $response = array('success' => false, 'message' => 'There is no file uploaded or there was an upload error.');
    }
    echo json_encode($response);
}
?>
