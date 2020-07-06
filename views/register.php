<?php include "header.php"; ?>
<?php include "navigation.php"; ?>
<p class="message red ui">
    <?php
    if ($msg = \Wiloke\Core\Session::get('register-error')) {
        echo $msg;
    }
    ?></p>

<form class="ui form" method="POST" action="<?php echo url('register'); ?>">

    <div class="fields three">
        <div class="field">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Username" required>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password" required>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Email" required>
        </div>
    </div>

    <!--    <div class="fields two">-->
    <!--        <div class="field">-->
    <!--            <label for="firstname">First name</label>-->
    <!--            <input id="firstname" type="text" name="firstname" placeholder="First name">-->
    <!--        </div>-->
    <!--        <div class="field">-->
    <!--            <label for="lastname">Last name</label>-->
    <!--            <input id="lastname" type="text" name="lastname" placeholder="Last name">-->
    <!--        </div>-->
    <!--    </div>-->
    <button class="ui button green" type="submit">Submit</button>
</form>
<?php include "footer.php"; ?>
