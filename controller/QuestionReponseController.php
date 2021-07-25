<?php



class QuestionReponseController {

    private $modele_qr;

    public function __construct()
    {
        $this->modele_qr = new Question_reponseModele();
    }


    public function addQuestion(){
        if(!empty($_POST['question'])){
            $this->modele_qr->addQuestion_reponse($_POST);
        }
    }

    public function getQuestionRep(){
        return $this->modele_qr->getQuestion_reponse();
    }

    public function getQuestions(){
        return $this->modele_qr->getAll("question");
    }

    public function editReponse(){
        return $this->modele_qr->editReponse($_GET['id']);
    }

    public function editQuestion(){
        return $this->modele_qr->editQuestion($_GET['id']);
    }

    public function update(){
        if( !empty($_POST['question']) ){
            $this->modele_qr->update($_POST);
        }
    }

    public function delete(){
        $this->modele_qr->delete("reponse", 'question', $_GET['id']);
        $this->modele_qr->delete("question", 'id', $_GET['id']);
        header("location: ?action=consulter");
        exit();
    }



}