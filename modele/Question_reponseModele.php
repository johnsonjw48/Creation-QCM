<?php



class Question_reponseModele extends ModeleGenerique {

	
	function addQuestion_reponse($question_reponse){
		$question = new Question($question_reponse);

		$query= "INSERT INTO question VALUES (NULL, :theme, :question, :auteur)";
		$stmt= $this->pdo->prepare($query);
		$stmt->execute([
				"theme"=> $question->getTheme(),
				"question"=>$question->getQuestion(),
				"auteur"=>$question->getAuteur()
		]);

		$lastId = $this->pdo->lastInsertId();

        for ($i = 1; $i <= 3; $i++){
            $marqueur = "rep_" . $i == $question_reponse['marqueur'] ? 1 : 0;


            $reponse = new Reponse( ["reponse" => $question_reponse['proposition_'.$i], "marqueur" => $marqueur, "question" => $lastId] );

            $query = "INSERT INTO reponse VALUES(NULL, :reponse, :marqueur, :id_question)";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute( [
                "reponse" => $reponse->getReponse(),
                "marqueur" => $reponse->getMarqueur(),
                "id_question" => $reponse->getQuestion()
            ] );

        }
        header("location: ?action=consulter");
        exit();
	}

	public function update($question_reponses){
        $question = new Question($question_reponses);
        $query = "UPDATE question SET theme = ?, question = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$question->getTheme(), $question->getQuestion(), $question->getId()]);

        for ($i = 1; $i <= 3; $i++){
            $marqueur = "rep_" . $i == $question_reponses['marqueur'] ? 1 : 0;


            $reponse = new Reponse( ["id" => $question_reponses['id_reponse_'.$i], "reponse" => $question_reponses['proposition_'.$i], "marqueur" => $marqueur, "question" => $question->getId()] );

            $query = "UPDATE reponse SET reponse = ?, marqueur = ? WHERE id = ?";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute( [
                $reponse->getReponse(),
                $reponse->getMarqueur(),
                $reponse->getId()
            ] );
            header("location: ?action=consulter");
            exit();
        }
    }


    public function getQuestion_reponse(){
        $query = "SELECT reponse.* FROM question, reponse WHERE question.id = reponse.question";
        $rep = $this->pdo->query($query);

        return $rep->fetchAll();
    }

    public function editQuestion($id){
        $query = "SELECT * FROM question WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function editReponse($id){
        $query = "SELECT * FROM reponse WHERE question = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}


