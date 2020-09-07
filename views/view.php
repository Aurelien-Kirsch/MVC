<?php 


class View{

    //fichier vue
    private $_file;

    //titre de la page
    private $_t;

    public function __construct($action){
        $this->_file = 'views/view'.$action.'.php';
    }

    //fonction qui va générer la vue
    public function generate($data){
        //on définit le contenu à envoyer
        $content = $this->generateFile($this->_file, $data);

        //template
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    private function generateFile($file, $data){
        if(file_exists($file)){
            ectract($data);

            //temporisation
            ob_start();

            require $file;

            //arrèt de la temporisation
            return ob_get_clean();
        }
        else{
            throw new \Exception("Fichier".$file."introuvable", 1);
        }
    }
}


?>