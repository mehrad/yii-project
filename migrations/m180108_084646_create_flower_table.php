<?php

use yii\db\Migration;

/**
 * Handles the creation of table `flower`.
 */
class m180108_084646_create_flower_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('flower', [
            'id' => $this->primaryKey(),
            'likeCount' => $this->integer()->defaultValue(1),
            'createdAt' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('flower');
    }
}
