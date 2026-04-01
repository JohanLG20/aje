<?php

namespace AJE\Model;

class VFilterTypeAssociations
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
    }

    public function getChoicesForFilterId(string $id): array|bool
    {
        try {
            $query = $this->db->prepare("SELECT * FROM FILTER_VALUES_ASSOCIATIONS WHERE id_filter_type = :id");
            $query->bindParam(":id", $id);

            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Une erreur est survenue lors de la connexion à la base de données" . $e->getMessage());
        }
    }
}
