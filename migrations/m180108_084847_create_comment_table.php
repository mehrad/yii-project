<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 * Has foreign keys to the tables:
 *
 * - `flower`
 */
class m180108_084847_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'flowerId' => $this->integer()->notNull(),
            'title' => $this->string(),
            'body' => $this->text(),
            'createdAt' => $this->timestamp()->notNull(),
        ]);

        // creates index for column `flowerId`
        $this->createIndex(
            'idx-comment-flowerId',
            'comment',
            'flowerId'
        );

        // add foreign key for table `flower`
        $this->addForeignKey(
            'fk-comment-flowerId',
            'comment',
            'flowerId',
            'flower',
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
            'fk-comment-flowerId',
            'comment'
        );

        // drops index for column `flowerId`
        $this->dropIndex(
            'idx-comment-flowerId',
            'comment'
        );

        $this->dropTable('comment');
    }
}
