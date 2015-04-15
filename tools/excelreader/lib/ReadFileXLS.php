<?php
include_once 'reader.php';

class ReadFileXLS{
    
    private $_data = null;
    
    public function __construct($file) {
        if(file_exists($file)){
            $this->_data = new Spreadsheet_Excel_Reader();
            $this->_data->setOutputEncoding('UTF-8');
            $this->_data->read($file);
        }else{
            echo "file not exits";
        }
    }
    
    public function getData(){
        return $this->_data;
    }
    
    public function getDadosExcel(){
        
        $dados = array();
        
        $this->_data->sheets[0]['cells'];
        
        // monta campos
        $campo = $this->_data->sheets[0]['cells'][1]; 
        
        unset($this->_data->sheets[0]['cells'][1]);
        
        foreach($this->_data->sheets[0]['cells'] as $v){ 
            
            foreach($v as $k => $n){ 
                $ns[$campo[$k]] = $n;
            }        
         $dados[] = $ns; 
         unset($ns);
        } 
        
        return $dados;          
    }
    
}

?>
