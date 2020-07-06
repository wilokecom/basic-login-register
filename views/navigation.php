<?php
use \Wiloke\Core\App;
use \Wiloke\Core\Request;
?>
<div class="ui menu">
    <div class="header item">
        <a href="<?php echo escUrl(App::get('config/app')['homeURL']); ?>">Wiloke</a>
    </div>
    <?php
    foreach (App::get('config/app')['navigation'] as $route => $aItem):
        if (isset($aItem['conditional'])) {
            if (App::get('Validation')->passedAllConditional($aItem['conditional'])) {
                continue;
            }
        }
        ?>
        <a class="<?php echo Request::uri() === $route ? 'active item' : 'item'; ?>"
           href="<?php echo escUrl(App::get('config/app')['homeURL'].$route); ?>">
            <?php echo escHtml($aItem['name']); ?>
        </a>
    <?php endforeach; ?>
</div>
<div id="content">
