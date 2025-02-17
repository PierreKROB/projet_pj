<?php

namespace App\Models;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;


class ParticipationModel extends BaseModel
{
    private $collection;

    public function __construct()
    {
        parent::__construct();
        
        $this->collection = $this->getCollection('participations');
    }
 
    public function createParticipation($userId, $quizId, $score)
    {
        return $this->collection->insertOne([
            'user_id' => new ObjectId($userId),
            'quiz_id' => new ObjectId($quizId),
            'score' => $score,
            'played_at' => new UTCDateTime(),
        ]);
    }

    public function getParticipationsByUserId($userId)
    {
        return $this->collection->find(['user_id' => new ObjectId($userId)])->toArray();
    }

    public function getParticipationsByQuizId($quizId)
    {
        return $this->collection->find(['quiz_id' => new ObjectId($quizId)])->toArray();
    }

    public function getAllParticipations()
    {
        return $this->collection->find()->toArray();
    }
}
