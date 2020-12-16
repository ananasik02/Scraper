<?php require 'header.php'; ?>
    <link rel="stylesheet" href="../styles/main.css">
    <div class="container">
        <ul class="catalog" style="">
        <?php foreach ($goods as $good ):?>
        <li class="catalog-item" style="">
            <div class="item-holder">
                <div class="image-holder">
                    <img src="<?= $good->image  ?>" width="310" height="430">
                    <span class="item-overlay">
                        <span class="item-title">
                             <?= $good->title ?>
                        </span>
                    </span>
                </div>
                <div class="content">

                </div>
                <div class="info-holder">
                    <span class="price-holder"><?= $good->price ?></span>
                    <div class="favorite-holder">
                        <div class="favorite-counter">
                            <span><?= $good->likes ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
        </ul>
        <?php
        for($page=1; $page <= 5; $page++): ?>
            <form style="display: inline-block" action="?action=set-page" method="post">
                <button class="btn btn-sm btn btn-light" name="page" value="<?php echo $page?>"><?= $page ?></button>
            </form>

        <?php endfor; ?>

    </div>
<?php require 'footer.php' ?>