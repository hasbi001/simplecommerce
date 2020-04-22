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
    <span id="message"></span>
    <div class="row">
        <div class="col-md-6">
            <table>
                <?php foreach ($model as $key => $value) { ?>
                    <tr>
                        <td><?php echo Html::img('@web/hp/'.$value->images) ?> <br> <?= $value->name ?></td>
                        <td><input type="number" name="quantity" id="hp<?= $value->id?>"></td>
                        <td><button class="btn btn-default" onclick="<?= new JsExpression('addToCart('.$value->id.')') ?>">Add to Cart</button></td>
                    </tr>
                <?php } ?>
            </table>   
        </div>
        <div class="col-md-6">
            <label id="title-order"></label>
            <table class="hide" id="orderTable">
                <thead>
                    <tr>
                        <td>Item</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><span id="totalprice"></span></td>
                    </tr>
                </tfoot>
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
                  data: {id:id,quantity:$('#hp'+id).val()},
                  success: function(result){
                    if(result.status == 200){
                        $('#orderTable').css('display','block');
                        var newRow=document.getElementById('orderTable').insertRow();
                        newRow.innerHTML = '<td>'+result.name+'</td>'+'<td>'+result.quantity+'</td>'+'<td>'+result.price+'</td>'+'<td><a href=\'#\'>delete</a></td>';
                        $('#totalprice').text(result.total);
                    }
                    $('#message').text(result.message);
                  },
                  dataType: 'JSON'
            });   
        }
    ",View::POS_READY);
?>