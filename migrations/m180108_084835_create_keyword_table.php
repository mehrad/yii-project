<?php

use yii\db\Migration;

/**
 * Handles the creation of table `keyword`.
 */
class m180108_084835_create_keyword_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('keyword', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'createdAt' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('keyword');
    }
}
