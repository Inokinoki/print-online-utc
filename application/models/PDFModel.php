<?php
class PDFModel extends FileModel{

    public function __construct()
    {
        parent::__construct();
    }

    public function isPDF(){
        if ($this->_srcFile == NULL)
            return false;
        $path = $this->_srcFile["tmp_name"];
        $magic = "%PDF-";
        if (!$fp = @fopen($path,"r")) {  
            $error = "Open file {$path} failed.";  
            return false;  
        } else {
            $magicInFile = fgets($fp, 6);
            if ($magic === $magicInFile)
                return true;
            else
                return false;
        }
    }

    public function getPage($path = NULL){
        if ($this->_srcFile == NULL)
            return 9999;
        if ($path == NULL)
            $path = $this->_srcFile["tmp_name"];
        if (!$fp = @fopen($path,"r")) {  
            $error = "Open file {$path} failed.";  
            return 9999;  
        } else {  
            $max=0;  
            while(!feof($fp)) {  
                $line = fgets($fp,255);  
                if (preg_match('/\/Count [0-9]+/', $line, $matches)){  
                    preg_match('/[0-9]+/',$matches[0], $matches2);  
                    if ($max<$matches2[0]) $max=$matches2[0];  
                }  
            }  
            fclose($fp);  
            // 返回页数  
            return $max;
        }  
    }

    public function save($username){
        if ($this->_srcFile != NULL && $this->isPDF()){
            $logger = new LogModel();
            $name = $username.".".time().".pdf";
            if (file_exists(APP_PATH. "/upload/" . $name)){
                $logger->logWithOperation("Save File Failed", $name);
                return false;
            } else {
                move_uploaded_file($this->_srcFile["tmp_name"], APP_PATH. "/upload/" . $name);
                $logger->logWithOperation("Saved File", $name);
                // id	size	name	belong	time
                $data = array(
                    "id" => "NULL",
                    "size" => $this->_srcFile["size"],
                    "name" => $name,
                    "belong" => $username,
                    "time" => "NULL",
                    "page" => $this->getPage(APP_PATH . "/upload/" . $name)
                );
                $this->add($data);
                return $name;
            }
        }
    }
}