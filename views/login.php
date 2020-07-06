<?php include  "header.php"; ?>
<?php include  "navigation.php"; ?>

<form class="ui form" method="POST" action="<?php echo url('login'); ?>">
    <div class="field">
        <label for="username">Username / Email</label>
        <input id="username" type="text" name="username" placeholder="Username" required>
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="ui button green" type="submit">Submit</button>
</form>

<?php include  "footer.php"; ?>
