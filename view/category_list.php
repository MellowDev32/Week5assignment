<?php include('../view/header.php') ?>

<?php if($categories) { ?>
<secion>
    <header>
        <h1>Category List</h1>
    </header>
    <br>
    <table>
    <?php foreach ($categories as $category) : ?>
        <tr>
            <td>
                <?= $category['categoryName']; ?>
            </td>
            <td>
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="category_id" value="<?= $category['categoryID'] ?>">
                    <button class="remove-button">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</secion>
<?php } else { ?>
<p>No categories exist yet.</p>
<?php } ?>


<section id="add" class="add">
    <br>
    <br>
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputes">
            <label>Name:</label>
            <input type="text" name="category_name" maxlength="50" placeholder="Name" autofocus required>
        </div>
        <br>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
    <br>
    <br>
    <p><a href=".">View/Add Items</a></p>
</section>

<?php include('../view/footer.php') ?>



