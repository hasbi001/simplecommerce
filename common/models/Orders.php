<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property int $item_id
 * @property int $quantity
 * @property int $price
 * @property string|null $time_created
 *
 * @property Checkout[] $checkouts
 * @property Items $item
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'item_id', 'quantity', 'price'], 'required'],
            [['user_id', 'item_id', 'quantity', 'price'], 'integer'],
            [['time_created'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'code' => 'Code',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'time_created' => 'Time Created',
        ];
    }

    /**
     * Gets query for [[Checkouts]].
     *
     * @return \yii\db\ActiveQuery|CheckoutQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery|ItemsQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
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
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
