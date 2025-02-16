<?php

namespace App\Models;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;


class QuizModel extends BaseModel
{
    private $collection;

    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->getCollection('quizzes');
    }

    public function createQuiz($title, $difficulty, $category, $questions)
    {
        return $this->collection->insertOne([
            'title' => $title,
            'difficulty' => $difficulty,
            'category' => $category,
            'questions' => $questions,
            'created_at' => new UTCDateTime(),
        ]);
    }

    public function findQuizById($id)
    {
        return $this->collection->findOne(['_id' => new ObjectId($id)]);
    }

    public function getAllQuizzes()
    {
        return $this->collection->find()->toArray();
    }
}
