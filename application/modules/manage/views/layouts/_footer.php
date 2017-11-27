<?php
use common\utils\Param;

/** @var $this \common\extend\View */
?>
<footer id="footer">
    <div class="container">
        <p>Copyright &copy; <?= date('Y') ?> <a href="/"><?= Param::Get("site.title") ?></a>. All Rights Reserved</p>
        <p><?= $this->ICPNumber() ?></p>
    </div>
</footer>
