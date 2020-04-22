<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string|null $address
 * @property string $email
 * @property int $card_number
 * @property int $exp_month
 * @property int $exp_year
 * @property int $cvc
 * @property string|null $time_created
 *
 * @property Orders $order
 * @property User $user
 */
class Checkout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'email', 'card_number', 'exp_month', 'exp_year', 'cvc'], 'required'],
            [['user_id', 'order_id', 'card_number', 'exp_month', 'exp_year', 'cvc'], 'integer'],
            [['time_created'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 60],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'address' => 'Address',
            'email' => 'Email',
            'card_number' => 'Card Number',
            'exp_month' => 'Exp Month',
            'exp_year' => 'Exp Year',
            'cvc' => 'Cvc',
            'time_created' => 'Time Created',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CheckoutQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CheckoutQuery(get_called_class());
    }
}
