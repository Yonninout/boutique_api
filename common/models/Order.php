<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $id_customer
 * @property double $total_price
 * @property string $created_at
 * @property string $delivery_adress
 *
 * @property IsOrdered[] $isOrdereds
 * @property Customer $customer
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_customer', 'total_price', 'created_at', 'delivery_adress'], 'required'],
            [['id_customer'], 'integer'],
            [['total_price'], 'number'],
            [['created_at'], 'string', 'max' => 45],
            [['delivery_adress'], 'string', 'max' => 255],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['id_customer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_customer' => 'Id Customer',
            'total_price' => 'Total Price',
            'created_at' => 'Created At',
            'delivery_adress' => 'Delivery Adress',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsOrdereds()
    {
        return $this->hasMany(IsOrdered::className(), ['id_order' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'id_customer']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
