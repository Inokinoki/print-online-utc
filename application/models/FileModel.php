<?php
class FileModel extends Model{

    public function __construct()
    {
        $this->_table = "File";
        parent::__construct();

        $logger = new LogModel();
        // Get file
        $this->_srcFile = NULL;
        if (isset(Model::$_params["FILES"]["file"]))
            $this->_srcFile = Model::$_params["FILES"]["file"];
        if($this->_srcFile != NULL){
            if ($this->_srcFile["error"] > 0){
                //$this->_error .= "Error: " . $this->_srcFile["error"] . "<br/>";
                switch ($this->_srcFile["error"]){
                case "1":
                    /*
                    UPLOAD_ERR_INI_SIZE
                    其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
                    */
                    $this->_error .= "[1001]File too big.<br/>";
                    break;
                case "2":
                    /*
                    UPLOAD_ERR_FORM_SIZE
                    其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
                    */
                    $this->_error .= "[1002]File too big.<br/>";
                    break;
                case "3":
                    /*
                    UPLOAD_ERR_PARTIAL
                    其值为 3，文件只有部分被上传。
                    */               
                    $this->_error .= "[1003]File not complete.<br/>";
                    break;
                case "4":
                    /*
                    UPLOAD_ERR_NO_FILE
                    其值为 4，没有文件被上传。
                    */
                    $this->_error .= "[1004]File not uploaded.<br/>";                               
                    break;
                case "6":
                    /*
                    UPLOAD_ERR_NO_TMP_DIR
                    其值为 6，找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进。
                    */
                    $this->_error .= "[1006]File not found.<br/>";
                    break;
                case "7":
                    /*
                    UPLOAD_ERR_CANT_WRITE
                    其值为 7，文件写入失败。PHP 5.1.0 引进。
                    */
                    $this->_error .= "[1007]File write failed.<br/>";
                    break;
                default:
                    $this->_error .= "[".(1000 + $this->_srcFile["error"])."]Unknown error.<br/>";
                    break;
                }
                
                $logger->logWithOperation("Upload File Failed", 
                    "Error:".$this->_error.
                    " Size:".$this->_srcFile["size"].
                    " Name:".$this->_srcFile["name"]);
            } else {
                if (APP_DEBUG){
                    echo "Upload: " . $this->_srcFile["name"] . "<br />";
                    echo "Type: " . $this->_srcFile["type"] . "<br />";
                    echo "Size: " . ($this->_srcFile["size"] / 1024) . " Kb<br />";
                    echo "Stored in: " . $this->_srcFile["tmp_name"];
                }
            }
        } else {
            $this->_error .= "[1004]File not uploaded.<br/>";
            $logger->logWithOperation("Upload File Failed", "Error:".$this->_error);
        }
    }

    protected $_srcFile;
    protected $_error;
   

    public function getError(){ return $this->_error; }
    public function getName(){ return $this->_srcFile["name"]; }
    public function getSize(){ return $this->_srcFile["size"]; }

}