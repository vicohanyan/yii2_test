<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $product_code
 * @property string $name
 * @property string $description
 * @property int $count
 * @property string $brand
 * @property int $size
 * @property int $category_id
 *
 * @property Category[] $categories
 * @property ProductAttachment[] $productAttachments
 */
class Product extends \yii\db\ActiveRecord
{

    public $attachment;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_code', 'count', 'size','attachment'], 'default', 'value' => null],
            [['product_code', 'count', 'size','category_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'brand'], 'string', 'max' => 255],
            [['attachment'],
                'file',
                'maxFiles'    => 9,
                'extensions'  => 'png, jpg, jpeg, mp4',
                'maxSize'     => 1024 * 1024 * 20,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'product_code' => 'Product Code',
            'name'         => 'Name',
            'description'  => 'Description',
            'count'        => 'Count',
            'brand'        => 'Brand',
            'size'         => 'Size',
            'attachment'   => 'Attachment',
            'category_id'  => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttachments()
    {
        return $this->hasMany(ProductAttachment::className(), ['product_id' => 'id']);
    }

}
