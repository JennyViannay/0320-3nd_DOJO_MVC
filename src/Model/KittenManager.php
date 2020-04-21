<?php

namespace App\Model;

class KittenManager extends AbstractManager
{

    const TABLE = 'kitten';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectKittenStats($id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM stats WHERE kitten_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}