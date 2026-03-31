<?php

namespace AJE\Model;

class DBCategory extends CoreModel
{
        public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CATEGORY";
        $this->tableNameLower = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented");
    }
    protected function prepareModifyQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented yet");
    }

    public function getAllParentsIds(string $id, array $ids = [])
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT id_category_parent_of FROM CATEGORY WHERE id_category = :id");
            $query->execute([":id" => $id]);
            $idParent = $query->fetch(\PDO::FETCH_NUM);

            if (isset($idParent[0])) {
                array_push($ids, $idParent[0]);                
                return self::getAllParentsIds($idParent[0], $ids);
            } else {
                return $ids;
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function test() : void {
        var_dump($this->db);
    }
}