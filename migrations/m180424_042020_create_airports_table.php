<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airports`.
 */
class m180424_042020_create_airports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('airports', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3)->defaultValue(''),
            'name' => $this->string(64)->defaultValue(''),
            'contry' => $this->smallInteger(6)->unsigned()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('airports');
    }
}
