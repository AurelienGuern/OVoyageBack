<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageHandler {

  private $params;

  public function __construct(ParameterBagInterface $params)
  {
    $this->params = $params;
  }

  public function processUploadBase64($base64Content, $type)
  {
    $base64 = $this->extractBase64String($base64Content);

    // TODO: gestion erreurs etc.
    $fileName = $this->saveFileBase64($base64, $type);

    return $fileName;
  }

  public function saveFileBase64($base64DataAndFileType, $type) {
    $uploadsDirectoryPath = $this->params->get('uploads_directory');

    $data = base64_decode($base64DataAndFileType[0]);
    $fileName = uniqid($type) .  ($base64DataAndFileType[1] ? $base64DataAndFileType[1] : "");
    $filePath = $uploadsDirectoryPath . '/' . $fileName;

    file_put_contents($filePath, $data);

    // TODO: ajouter condition pour retourner le filePath que si c'est ok
    return $fileName; 
  }

  public function extractBase64String(string $base64Content)
  {
    $array = [];

    $data = explode(';base64,', $base64Content);
    $array[] = $data[1];

    $fileTypeAux = explode("image/", $data[0]);
    $fileType = $fileTypeAux[1];

    if ($fileType === "jpeg") {
      $array[] = ".jpg";
    }
    if ($fileType === "png") {
      $array[] = ".png";
    }

    return $array;
  }

  public function deleteImage($fileName) {
    $uploadsDirectoryPath = $this->params->get('uploads_directory');
    
    $deleted = unlink($uploadsDirectoryPath . '/' . $fileName);

    return $deleted;
  }
}
