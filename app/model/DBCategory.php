<?php

namespace AJE\Model;

class DBCategory extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CATEGORY";
        $this->idName = strtolower($this->tableName);
    }

    public function getCompleteBranch(string $id, array $ids = [])
    {
        array_push($ids, $id); //Adding the current category to the branch
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT id_category_parent_of FROM CATEGORY WHERE id_category = :id");
            $query->execute([":id" => $id]);
            $idParent = $query->fetch(\PDO::FETCH_ASSOC);

            if (isset($idParent['id_category_parent_of'])) {
                return $this->getCompleteBranch($idParent['id_category_parent_of'], $ids);
            } else {
                return $ids;
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}
