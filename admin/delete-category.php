<?php
require_once '../init.php';
checkUserLoggedIn();

if (isPostRequest()) {
    $catId = getPostData('delete_cat_id', null);
    $category = new Category();

    if ($category->deleteCategory($catId)) {
        redirect('admin/index.php?source=view_edit_categories');
    } else {
        $_SESSION['error'] = "Failed to delete category.";
    }
}
