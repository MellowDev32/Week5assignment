<?php include '../view/header.php'; ?>

<section>
    <header class="list__row list__header">
        <h1>Items</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_assignments">
            <select name="category_id" required>
                <option value="0">View All</option>
                <?php foreach ($categories as $category) : ?>
                <?php if($category_id == $category['categoryID']){ ?>
                    <option value="<?= $category['categoryID'] ?>" selected>
                <?php } else { ?>
                    <option value="<?= $category['categoryID'] ?>">
                <?php } ?>
                        <?= $category['categoryName'] ?>
                    </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
    <?php if($items) { ?>
    <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <?= get_category_name($item['categoryID']) ?>
                </td>
                <td>
                    <?= $item['Title'] ?>
                </td>
                <td>
                    <?= $item['Description'] ?>
                </td>
                <td><form action="." method="post">
                            <input type="hidden" name="action" value="delete_item">
                            <input type="hidden" name="item_id" value="<?=$item['itemID']?>">
                            <button class="remove-button">Complete</button>
                </form></td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php } else { ?>
        <br>
        <?php if($category_id) { ?>
        <p>
            No items exist for this category yet.
        </p>
        <?php } else { ?>
        <p>
            No items exist yet.
        </p>
        <?php } ?>
        <br>
    <?php } ?>
</section>


<section id="add" class="add">
    <h2>Add Item</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_item">
        <table id="add-table">
            <tr>
                <td>
                    <label>Category:</label>
                </td>
                <td>
                    <select name="category_id" required>
                        <option value="">Please select</option>
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['categoryID']; ?>">
                            <?= $category['categoryName']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Title:</label>
                </td>
                <td>
                    <input type="text" name="title" maxlength="120" placeholder="Title" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Description:</label>
                </td>
                <td>
                    <input type="text" name="description" maxlength="120" placeholder="Description" required>
                </td>
            </tr>
        </table>
        <br>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
        
        <!--
        <div class="add__inputs">
            <label>Category:</label>
            
            
            <label>Title:</label>
            <input type="text" name="title" maxlength="120" placeholder="Title" required>
       
            <label>Description:</label>
            <input type="text" name="description" maxlength="120" placeholder="Description" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
        -->
</section>
<br>
<p><a href=".?action=list_categories">View/Edit Categories</a></p>
<?php include '../view/footer.php'; ?>