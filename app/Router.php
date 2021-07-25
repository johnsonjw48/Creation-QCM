<?php

include "controller/PersonneController.php";
include "controller/QuestionReponseController.php";

include "modele/PersonneModele.php";
include "modele/Question_reponseModele.php";

class Router {

    private $ctrPersonne;
    private $ctrQuestionRep;

    public function __construct(){
        $this->ctrPersonne = new PersonneController();
        $this->ctrQuestionRep = new QuestionReponseController();
    }

    public function requeteUrl(){
        if ( isset($_GET['action']) ){
            $action = $_GET['action'];

            if ($action == "inscription") {
                include "views/inscription.phtml";
                if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                    $this->ctrPersonne->inscription();
                }
            }elseif ($action == "connexion"){
                include "views/connexion.phtml";
                if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                    $this->ctrPersonne->connexion();
                }
            }elseif ($action == "deconnexion"){
                session_destroy();
                header("Location: .");
                exit();
            }elseif ($action == "deposer"){
                include 'views/deposer.phtml';
                if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                    $this->ctrQuestionRep->addQuestion();
                }
            }elseif ($action == "consulter"){
                $reponses = $this->ctrQuestionRep->getQuestionRep();
                $questions = $this->ctrQuestionRep->getQuestions();
                $compteur = 0;
                $next = 0;
                include 'views/consulter.phtml';
            }elseif ($action == "edit"){
                if( isset($_GET['id']) && ctype_digit($_GET['id']) ){
                    $question = $this->ctrQuestionRep->editQuestion();
                    $reponse = $this->ctrQuestionRep->editReponse();
                    include 'views/deposer.phtml';

                    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                        $this->ctrQuestionRep->update();
                    }
                }

            }elseif ($action == "delete"){
                if( isset($_GET['id']) && ctype_digit($_GET['id']) ){
                    $this->ctrQuestionRep->delete();
                }
            }elseif ($action == "user"){
                if( isset($_GET['id']) && ctype_digit($_GET['id']) ){
                    $personne = $this->ctrPersonne->edit();
                    include 'views/inscription.phtml';
                    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                        $this->ctrPersonne->edit();
                    }
                }
            }else{
                echo "pas d'action";
            }
        } else{
            include "views/template.phtml";
        }
    }

}