<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flights".
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property int $back
 * @property string $start
 * @property string $stop
 * @property int $adult
 * @property int $child
 * @property int $infant
 * @property string $price
 */
class Flights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'integer'],
            [['start', 'stop'], 'safe'],
            [['price'], 'number'],
            [['back', 'adult', 'child', 'infant'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'back' => 'Back',
            'start' => 'Start',
            'stop' => 'Stop',
            'adult' => 'Adult',
            'child' => 'Child',
            'infant' => 'Infant',
            'price' => 'Price',
        ];
    }
}
