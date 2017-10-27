<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Categorys;
use app\controllers\SiteController;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => SiteController::getNameMagazin(),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $categorys = Categorys::find()->orderby(['c_name' => 'SORT_ASC'])->all();
    $categoryItems = [];
    foreach ($categorys as $category) {
        array_push($categoryItems,
            [
                'label' => $category->c_name,
                'url' => ['products/show-by-category', 'idCategory' => $category->id]
            ]
        );
    }
    // print_r($categoryItems);die();
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Категории', 'url' => ['/categorys/index']],
            ['label' => 'Товары', 'url' => ['/products/index']],
            [
                'label' => 'Товары по категориям',
                'url' => ['/categorys/index'],
                'options' => ['class' => 'dropdown'],
                'template' => '<a href="{url}" class="{url-class}">{label}</a>',
                'items' => $categoryItems
            ],
            ['label' => 'Журнал', 'url' => ['/log/index']],
            ['label' => 'Приход', 'url' => ['/log/index', 'type'=>'add']],
            ['label' => 'Расход', 'url' => ['/log/index', 'type'=>'sale']],
            // ['label' => 'About', 'url' => ['/site/about']],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
            // Yii::$app->user->isGuest ? (
            //     ['label' => 'Login', 'url' => ['/site/login']]
            // ) : (
            //     '<li>'
            //     . Html::beginForm(['/site/logout'], 'post')
            //     . Html::submitButton(
            //         'Logout (' . Yii::$app->user->identity->username . ')',
            //         ['class' => 'btn btn-link logout']
            //     )
            //     . Html::endForm()
            //     . '</li>'
            // )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= 'Магазин' . ' "' . SiteController::getNameMagazin() . '" ';?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
