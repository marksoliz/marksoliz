<?php

$category = new Category();
$message = '';
$error = '';

// Handle form submission for adding a category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $slug = strtolower(str_replace(' ', '-', $name));

    try {
        if ($category->createCategory($name, $slug)) {
            $message = "Category added successfully!";
        } else {
            $error = "Failed to add category.";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Handle form submission for editing a category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_category'])) {
    $id = (int)$_POST['category_id'];
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $slug = strtolower(str_replace(' ', '-', $name));

    try {
        if ($category->updateCategory($id, $name, $slug)) {
            $message = "Category updated successfully!";
        } else {
            $error = "Failed to update category.";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Fetch all categories
$categories = $category->getAllCategories();
?>

<div class="container mt-4">
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-4">
            <h3><?php echo isset($_GET['edit']) ? 'Edit Category' : 'Add Category'; ?></h3>
            <?php if (!empty($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST" action="">
                <?php if (isset($_GET['edit'])): ?>
                    <input type="hidden" name="category_id" value="<?= (int)$_GET['edit']; ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= isset($_GET['edit']) ? htmlspecialchars($category->getCategoryById((int)$_GET['edit'])->name) : ''; ?>"
                        required>
                </div>
                <button type="submit" name="<?= isset($_GET['edit']) ? 'edit_category' : 'add_category'; ?>" class="btn btn-primary">
                    <?= isset($_GET['edit']) ? 'Update Category' : 'Add Category'; ?>
                </button>
            </form>
        </div>

        <!-- Table Section -->
        <div class="col-md-8">
            <h3>Categories</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?= $cat->id; ?></td>
                            <td><?= htmlspecialchars($cat->name); ?></td>
                            <td><?= htmlspecialchars($cat->slug); ?></td>
                            <td>
                                <a href="?source=view_edit_categories&edit=<?= $cat->id; ?>" class="btn btn-sm btn-warning">Edit</a>

                            </td>
                            <td>
                                <form onsubmit="return confirmDeleteCategory(<?php echo $cat->id; ?>)" method="post" action="<?php echo base_url('admin/delete-category.php'); ?>">
                                    <input type="hidden" name="delete_cat_id" value="<?php echo $cat->id; ?>">
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>