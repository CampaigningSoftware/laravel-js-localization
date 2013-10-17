<?php
namespace JsLocalization;

use App;
use DateTime;
use Exception;
use Illuminate\Http\Response;

class StaticFileRequest extends Response
{
    public function __construct ($filePath)
    {
        parent::__construct();

        $fs = App::make('files');

        if (!$fs->isFile($filePath)) {
            throw new Exception("Cannot read file: $filePath");
        }

        $fileContent = file_get_contents($filePath);
        $this->setContent($fileContent);

        $lastModified = new DateTime();
        $lastModified->setTimestamp( $fs->lastModified($filePath) );

        $this->header('Last-Modified', $lastModified->format('D, d M Y H:i:s T'));
    }
}