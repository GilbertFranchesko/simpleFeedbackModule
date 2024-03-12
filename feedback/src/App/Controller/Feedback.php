<?php

namespace App\Controller;

use App\Model\FeedbackModel;
use App\Services\View;
use App\Services\PhotosSerializer;

use Exception;

class Feedback extends CRUDController {

    protected $model = FeedbackModel::class;

    public function __construct() { parent::__construct($this->model);}

    public function index() 
    {
        $feedbackList = $this->model->get();

        View::showView("Feedback", array(
            "feedbackList" => $this->model->get()
        ));
    }

    public function formAddFeedback()
    {
        if(isset($_POST))
        {
            try {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $benefits = $_POST['benefits'];
                $drawbacks = $_POST['drawbacks'];
                $description = $_POST['description'];  
                $rate = $_POST['rate'];

                $filename = null;
            } catch(Exception $e) {
                var_dump($e);
            }

            if(is_array($_FILES) && isset($_FILES) && count($_FILES) != 0)
            {
                $filename = time().'.jpg';
                $location = "upload/".$filename;

                if(move_uploaded_file($_FILES['photos']['tmp_name'], $location))
                {
                    echo "ok";
                }
                else throw new Exception("File dont uploaded.");
            }

            $serializedData = null;
            if($filename != null) { $serializedData = PhotosSerializer::serialize($filename); }

            $queryParams = array(
                "name" => $name,
                "email" => $email,
                "description" => $description, 
                "rate" => $rate,
                "benefits" => $benefits,
                "drawbacks" => $drawbacks,
                "document" => json_encode($serializedData)
            );

            $this->model->create($queryParams);
    
        }

    }


}