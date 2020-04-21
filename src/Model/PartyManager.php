<?php

namespace App\Model;

class PartyManager extends AbstractManager
{

    const TABLE = 'party';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $party)
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " (`player_1_id`, `player_2_id`, `status_id`) VALUES (:player_1_id, :player_2_id, :status_id)");

        $statement->bindValue('player_1_id', $party['player_1_id'], \PDO::PARAM_INT);
        $statement->bindValue('player_2_id', $party['player_2_id'], \PDO::PARAM_INT);
        $statement->bindValue('status_id', 1, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}