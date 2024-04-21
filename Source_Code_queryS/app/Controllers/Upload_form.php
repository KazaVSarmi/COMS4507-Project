<?php
namespace App\Controllers;

class Upload_form extends BaseController


{
	public function index() {
        $data['errors'] = "";
        echo view('upload_form', $data);
       
      
    }

    public function doUpload()
	{
		$fileInfos = array();
		$title = $this->request->getPost('title');
		$files = $this->request->getFiles();
		foreach ($files['userfile'] as $file) 
		{
			$randomName = $file->getRandomName();
			$data['title'] = $title;
			$data['fileName'] = $file->getName();
			$data['randomName'] = $randomName;
			$data['fileType'] = $file->getClientMimeType();
			$data['fileSize'] = $file->getSize();
			$file->move(WRITEPATH.'uploads', $randomName);
			array_push($fileInfos, $data);
		}
		
		$data['fileInfos'] = $fileInfos;
		return view('upload_form_success', $data);
	}

	
	public function do_drag_drop()
	{
		if ($files = $this->request->getFiles())
	{
			foreach ($files['file'] as $file)

			{
				if($file->isValid() && !$file->hasMoved())
				{
					// Get the file name and extension
					$name = $file->getName();
					$file->move(WRITEPATH . 'uploads', $name);
				}
			}
		}
	}
}