<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $photo_folder
 * @property string $description
 * @property double $price
 * @property int $quantity_sold
 * @property int $stock
 * @property int $be_sold
 *
 * @property IsOrdered[] $isOrdereds
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo_folder', 'description', 'price', 'quantity_sold', 'stock'], 'required'],
            [['price'], 'number'],
            [['quantity_sold', 'stock', 'be_sold'], 'integer'],
            [['photo_folder'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo_folder' => 'Photo Folder',
            'description' => 'Description',
            'price' => 'Price',
            'quantity_sold' => 'Quantity Sold',
            'stock' => 'Stock',
            'be_sold' => 'Be Sold',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsOrdereds()
    {
        return $this->hasMany(IsOrdered::className(), ['id_article' => 'id']);
    }
}
