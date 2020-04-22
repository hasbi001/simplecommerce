<?php

/* @var $this yii\web\View */

use yii\BaseYii as Yii;
use yii\web\View;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
$user = Yii::$app->user;
?>
<style type="text/css">
    .hide { display: none; }
</style>
<div class="site-index">
    <div class="row">
        <div class="col-md-6">
            <table>
                <?php foreach ($model as $key => $value) { ?>
                    <tr>
                        <td><?php echo Html::img('@web/hp/'.$value->images) ?> <br> <?= $value->name ?></td>
                        <td><input type="number" name="quantity" id="hp<?= $value->id?>"></td>
                        <td><a href="javascript:void(0)" class="btn btn-default" onclick="addToCart(<?= $value->id?>)">Add to Cart</a></td>
                    </tr>
                <?php } ?>
            </table>   
        </div>
        <div class="col-md-6">
            <label id="title-order"></label>
            <table class="hide">
                <tr>
                    <td>Item</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div> 
</div>
<?php
    $this->registerJs("
        function addToCart(id) {
            $.ajax({
                  type: 'GET',
                  url: '".Url::toRoute('site/add-cart')."',
                  data: {id:id},
                  success: function(result){

                    },
                  dataType: 'JSON'
            });   
        }
    ",View::POS_READY);
?>