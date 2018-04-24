<?php


namespace app\models;
use yii\db\ActiveRecord;

class Airports extends ActiveRecord
{


 	public static function tableName() {
        return 'airports';
    }

	public static function getIdByCode($code)
	{
		$model = self::find()->where(['code'=>$code])->one();
		if(count($model)>0){
			return $model->id;
		}
		else {
			return $model;
		}
	}

}