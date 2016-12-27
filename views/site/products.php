<?php

/* @var $this yii\web\View */
/* @var $categories \app\models\Baskets[] */

$this->title = 'Basket';
foreach ($categories as $category)
{
    var_dump($category);
    echo '<br>';
}
//var_dump(Yii::$app->i18n->translations);
?>
<section class="container mt-1">

    <div class="row" id="products">
        <div class="col-lg-10 offset-lg-1">

            <div id="categories">

                <?php
                foreach ($categories as $category):
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3" id="<?= $category['id'] ?>">
                    <div class="card card-outline-success text-xs-center">
                        <img class="card-img-top img-fluid" src="images/<?= $category['pictureName'] ?>" alt="Card image cap">
                        <span class="lead"><?= $category['name'] ?></span>
                    </div>
                </div>
                <?php
                endforeach;
                ?>

            </div>

            <div id="sublist" style="display: none"></div>
            <div id="productslist" style="display: none"></div>

        </div>
    </div>

</section>