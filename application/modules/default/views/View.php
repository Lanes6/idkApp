<?php

class View
{
    private $_file;
    private $_title;

    public function __construct($controller,$action,$title){
        $this->_file='application/modules/default/views/scripts/'.$controller.'/'.$action.'.html';
        $this->_title=$title;
    }

    public function generate($data)
    {
        $content = $this->generateFile($this->_file,$data);

        $view=$this->generateFile('application/modules/default/views/layout/mainLayout.html',
            array('title'=>$this->_title,'content'=>$content));

        echo $view;
    }

    private function generateFile($file,$data){
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }else{
            throw new Exception('Erreur lors de la construction de la vue'.$file);
        }
    }

}