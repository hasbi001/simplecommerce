<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Checkout]].
 *
 * @see Checkout
 */
class CheckoutQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Checkout[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Checkout|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
