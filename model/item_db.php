<?php
function get_items_by_category($category_id){
    global $db;
    if($category_id == NULL || $category_id == FALSE){
        $query = 'SELECT * FROM todoitems';
        $statement = $db->prepare($query);
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();
        return $items;
    } else {
        $query = 'SELECT * FROM todoitems WHERE todoitems.categoryID = :category_id ORDER BY itemID';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();
        return $items;
    }
}

function get_item($item_id){
    global $db;
    $query = 'SELECT * FROM todoitems WHERE itemID = :item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $item = $statement->fetchAll();
    $statement->closeCursor();
    return $item;
}

function delete_item($item_id){
    global $db;
    $query = 'DELETE * FROM todoitems WHERE itemID = :item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($title, $description, $category_id){
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description, categoryID) VALUES (:title, :description, :category_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}