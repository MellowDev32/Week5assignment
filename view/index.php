<?php
require('../model/database.php');
require('../model/item_db.php');
require('../model/category_db.php');

$item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING);

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if(!$category_id){
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action');
if(!$action){
    $action = filter_input(INPUT_GET, 'action');
    if(!$action){
        $action = 'list_items';
    }
}

switch($action) {
    case "list_categories":
        $categories = get_categories();
        include('../view/category_list.php');
        break;
    case "add_category":
        add_category($category_name);
        header("Location: .?action=list_categories");
        break;
    case "add_item":
        if($title && $description && $category_id){
            add_item($title, $description, $category_id);
            header("Location: .?action=list_items");
        } else {
            $error = "Invalid item data. Check all fields and try again.";
            include('../view/error.php');
            exit();
        }
        break;
    case "delete_category":
        if($category_id){
            try{
                delete_category($category_id);
            } catch (Exception $e) {
                $error = "Can't delete a category if items exist in the category.";
                include('../view/error.php');
                exit();
            }
            header("Loaction: .?action=list_categories");
        }
        break;
    case "delete_item":
        if ($item_id) {
            delete_item($item_id);
            header("Location: .?category_id=$category_id");
        } else {
            $error = "Missing or incorrect assignment id.";
            include('..view/error.php');
        }
    default: 
        $category_name = get_category_name($category_id);
        $categories = get_categories();
        $items = get_items_by_category($category_id);
        include('../view/item_list.php');
}
/*
if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $items = get_items_by_category($category_id);
    include('../view/item_list.php');
} else if ($action == 'delete_item'){
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE || $item_id == NULL || $item_id == FALSE){
        $error = "Missing or incorrect item id or category id.";
        include('error.php');
    } else {
        delete_item($item_id);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'show_add_form'){
    $categories = get_categories();
    include('add_item_form.php');
} else if ($action == 'add_item'){
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'title');
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE || $title == NULL || $description == NULL){
        $error = "Invalid item data. Check all fields and try again.";
        include('error.php');
    } else {
        add_item($title, $description, $category_id);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'list_categories'){
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    include('category_list.php');
} else if ($action == 'delete_category'){
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $error = "Missing or incorrect category id.";
        include('error.php');
    } else {
        delete_category($category_id);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'add_category'){
    $name = filter_input(INPUT_POST, 'name');
    if ($name == NULL){
        $error = "Invalid item data. Check all fields and try again.";
        include('error.php');
    } else {
        add_category($name);
        header("Location: .?category_id=$category_id");
    }
}
 */
?>