<?php
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\Contact;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$contact = new Contact($PDO);
$contact->fill($_POST);
if ($contact->validate()) {
$contact->save() && redirect('index.php');
}
$errors = $contact->getValidationErrors();
}
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php' ?>

    <!-- Main Page Content -->
    <div class="container">

        <?php
        $subtitle = 'Add your contacts here.';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3">

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="name" placeholder="Enter Name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" />

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control<?= isset($errors['phone']) ? ' is-invalid' : '' ?>" maxlen="255" id="phone" placeholder="Enter Phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" />

                        <?php if (isset($errors['phone'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['phone'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label for="notes">Notes </label>
                        <textarea name="notes" id="notes" class="form-control<?= isset($errors['notes']) ? ' is-invalid' : '' ?>" placeholder="Enter notes (maximum character limit: 255)"><?= isset($_POST['notes']) ? $_POST['notes'] : '' ?></textarea>

                        <?php if (isset($errors['notes'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['notes'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Add Contact</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
</body>

</html>