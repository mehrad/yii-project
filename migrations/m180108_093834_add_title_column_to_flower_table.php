<?php

use yii\db\Migration;

/**
 * Handles adding title to table `flower`.
 */
class m180108_093834_add_title_column_to_flower_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('flower', 'title', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('flower', 'title');
    }
}
