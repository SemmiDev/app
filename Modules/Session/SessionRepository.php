<?php

namespace Modules\Session\Repository;

use Modules\Session\Entity\SessionEntity;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(SessionEntity $session): SessionEntity
    {
        $statement = $this->connection->prepare("INSERT INTO sessions(id, user_id) VALUES (?, ?)");
        $statement->execute([$session->id, $session->userId]);
        return $session;
    }

    public function findById(string $id): ?SessionEntity
    {
        $statement = $this->connection->prepare("SELECT id, user_id from sessions WHERE id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()){
                $session = new SessionEntity();
                $session->id = $row['id'];
                $session->userId = $row['user_id'];
                return $session;
            }else{
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM sessions");
    }

}