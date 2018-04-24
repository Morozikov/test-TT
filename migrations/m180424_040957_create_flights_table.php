<?php

use yii\db\Migration;

/**
 * Handles the creation of table `flights`.
 */
class m180424_040957_create_flights_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('flights', [
            'id' => $this->primaryKey(),
            'from' => $this->smallInteger(6)->unsigned()->defaultValue(0),
            'to' => $this->smallInteger(6)->unsigned()->defaultValue(0),
            'back' => $this->tinyInteger(1)->unsigned()->defaultValue(0),
            'start' => $this->dateTime(),
            'stop' => $this->dateTime(),
            'adult' => $this->tinyInteger(1)->unsigned()->defaultValue(0),
            'child' => $this->tinyInteger(1)->unsigned()->defaultValue(0),
            'infant' => $this->tinyInteger(1)->unsigned()->defaultValue(0),
            'price' => $this->decimal(12,2)->defaultValue(0.00)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('flights');
    }
}
