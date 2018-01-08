<?php

use yii\db\Migration;

/**
 * Handles the creation of table `flower_keyword`.
 * Has foreign keys to the tables:
 *
 * - `flower`
 * - `keyword`
 */
class m180108_085002_create_flower_keyword_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('flower_keyword', [
            'id' => $this->primaryKey(),
            'flowerId' => $this->integer()->notNull(),
            'keywordId' => $this->integer()->notNull(),
            'createdAt' => $this->timestamp()->notNull(),
        ]);

        // creates index for column `flowerId`
        $this->createIndex(
            'idx-flower_keyword-flowerId',
            'flower_keyword',
            'flowerId'
        );

        // add foreign key for table `flower`
        $this->addForeignKey(
            'fk-flower_keyword-flowerId',
            'flower_keyword',
            'flowerId',
            'flower',
            'id',
            'CASCADE'
        );

        // creates index for column `keywordId`
        $this->createIndex(
            'idx-flower_keyword-keywordId',
            'flower_keyword',
            'keywordId'
        );

        // add foreign key for table `keyword`
        $this->addForeignKey(
            'fk-flower_keyword-keywordId',
            'flower_keyword',
            'keywordId',
            'keyword',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `flower`
        $this->dropForeignKey(
            'fk-flower_keyword-flowerId',
            'flower_keyword'
        );

        // drops index for column `flowerId`
        $this->dropIndex(
            'idx-flower_keyword-flowerId',
            'flower_keyword'
        );

        // drops foreign key for table `keyword`
        $this->dropForeignKey(
            'fk-flower_keyword-keywordId',
            'flower_keyword'
        );

        // drops index for column `keywordId`
        $this->dropIndex(
            'idx-flower_keyword-keywordId',
            'flower_keyword'
        );

        $this->dropTable('flower_keyword');
    }
}
