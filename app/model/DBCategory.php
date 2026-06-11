<?php

namespace AJE\Model;

class DBCategory extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CATEGORY";
        $this->idName = strtolower($this->tableName);
    }

    /**
     * A function that return the complete branches of a given category.
     * @param string $id The id of the category we want the branch
     * @param array $ids Leave this attributes empty, it is only used for recursivity
     * 
     * @return array The array containing all the ids of the parents category 
     */
    public function getCompleteBranch(string $id, array $ids = []): array
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

    /**
     * Returns an array of id of filters types that are associated to the given categories
     * @param array $cats An array of id of categories
     * 
     * @return array An array of ids of filters types
     */
    public function getAllFiltersForCategories(array $cats): array
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();

            $in  = str_repeat('?,', count($cats) - 1) . '?'; //Preparing each value for the request
            $sql = "SELECT id_filter_type FROM CATEGORY as c
                                    INNER JOIN FILTERED_BY as fb ON c.id_category = fb.id_category
                                    WHERE c.id_category IN ( $in )"; //Preparing the query

            $query = $db->prepare($sql);
            $query->execute($cats);

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}
