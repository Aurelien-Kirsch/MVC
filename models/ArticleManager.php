<?php 


class ArticleManager extends Model{

    //on va créé la fonction qui va récupérer tous les articles de la bdd
    public function getArticles(){
        return $this->getAll('articles', 'Article');
    }


}

?>