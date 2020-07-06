<?php include "header.php"; ?>
<?php include "navigation.php"; ?>
<form class="ui form" method="GET" action="<?php echo url('search'); ?>">
    <div class="ui form">
        <div class="field">
            <label for="search-field">Search Field</label>
            <input id="search-field" placeholder="Enter in a keyword" name="s" type="text">
        </div>
        <button type="submit" class="ui submit button">Submit</button>
    </div>
</form>
<?php include "footer.php"; ?>
