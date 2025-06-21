<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $status
 * @property string|null $items
 * @property int $total_price
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
            [['items'], 'default', 'value' => null],
            [['name', 'date', 'status', 'total_price'], 'required'],
            [['date'], 'safe'],
            [['items'], 'string'],
            [['total_price'], 'integer'],
            [['name', 'status'], 'string', 'max' => 255],
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
            'date' => 'Date',
            'status' => 'Status',
            'items' => 'Items',
            'total_price' => 'Total Price',
        ];
    }
    
     public function beforeSave($insert) {
         if (parent::beforeSave($insert)) {
             $this->total_price = $this->total_price + 10;
             return true;
         }
         return false;
     }
     
    // for api - отбрасываем некоторые поля. Лучше всего использовать в случае наследования
    public function fields()
    {
        $fields = parent::fields();

//        // удаляем небезопасные поля
//        unset($fields['date']);

        return $fields;
    }

}
