<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait FileUploadTrait
{
    /**
     * @var string
     */
    protected $uploadPath = 'upfiles';

    public $folderName;

    /**
     * For Handle Put File
     *
     * @param $file
     * @param string $folder_name
     * @return array
     */
    private function putFile($file, $folder_name = '')
    {
        $file_name = preg_replace('/\s+/', '_', time() . ' ' . $file->getClientOriginalName());

        $path =  "$this->uploadPath/";

        if($this->main_folder)
            $path .= "$this->main_folder/";

        if($folder_name)
            $path .= "$folder_name/";

        $extension = $file->getClientOriginalExtension();
        $file->move($path, $file_name);

        return compact('file_name', 'extension');
    }

    /**
     * For Handle Save File Process
     *
     * @param $files
     * @return array
     */
    public function saveFiles($files, $folder_name = '')
    {
        $data = [];

        if ($files != null) {

            if (is_array($files)) {
                foreach ($files as $file) {
                    $data[] = $this->putFile($file, $folder_name);
                }
            } else {
                $data[] = $this->putFile($files, $folder_name);
            }
        }

        return $data;
    }
}
