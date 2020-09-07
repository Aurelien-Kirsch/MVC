<?php 

require_once 'views/view.php';

class Router
{
    private $ctrl;
    private $view;

    public function routeRequest(){

        try{
            //chargement automatique des classes du dossier models
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            //on créé une variable $url
            $url = ''; 

            //on va déterminer le controller en fonction de la valeur de cette variable
            if (isset($_GET['url'])){

                //on décompose l'url et on lui applique un filtre
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                //on récupère le premier paramètre de $url, on le met en minuscule et sa première lettre en majuscule
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;

                //on retrouve le chemin du controller voulue
                $controllerFile = "controllers/".$controllerClass.".php";

                //on vérifie si le fichier du controller existe
                if (file_exists($controllerFile)){

                    //on lance la classe en question avec tous les paramètres url
                    require_once($controllerFile);
                    $this->ctrl = new controllerClass($url);
                }
                else {

                    throw new \Exception("Page introuvable",1);
                }

            }
            else {

                require_once('controller/ControllerAccueil.php');
                $this->ctrl = new ControllerAcceuil($url);
            }

        }
        catch (\Exception $e){

            $errorMessage = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
   
        }
    }


}
?>