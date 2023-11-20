<?php

namespace App\Model;

class ArticleManager extends AbstractManager
{
    public const TABLE = 'Article';

    public function selectRandomOne(): array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' ORDER BY RAND() LIMIT 1';
        $statement = $this->pdo->query($query);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function searchByTitle(string $search): array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' WHERE title LIKE :search';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
