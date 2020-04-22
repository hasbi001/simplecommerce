<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $name
 * @property string $images
 * @property int $price
 * @property string|null $description
 *
 * @property Orders[] $orders
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'images', 'price'], 'required'],
            [['price'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['images'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'images' => 'Images',
            'price' => 'Price',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrdersQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['item_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemsQuery(get_called_class());
    }
}
