<?php

namespace common\models;

use Yii;

//for rendering images
use yii\helpers\Html;


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


    public function getPhotosURLS(){
        $files = scandir('../../'.$this->photo_folder, SCANDIR_SORT_ASCENDING);
        foreach ($files as $key => $file) {
            if (is_dir($file)) {    
                unset($files[$key]);
            }else{
                $files[$key] = '@'.$this->photo_folder.$file; 
            }
        }
        return array_values($files);
    }

    public function getPhotos(){
        // $article = Article::find(1)->one();
        $photos = $this->getPhotosURLS();
        echo HTML::beginTag('div', ['class'=> 'row']);
        foreach ($photos as $key => $url) {
            //TODO Create alt description   
            echo Html::img($url, ['alt'=>'', 'class'=> 'col-lg-4', 'style' => '; max-height: auto']);
        }
        echo HTML::endTag('div');
    }

}
