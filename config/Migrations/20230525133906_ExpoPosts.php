<?php
declare(strict_types=1);

use BaserCore\Database\Migration\BcMigration;

class ExpoPosts extends BcMigration
{
    public function up()
    {
        $this->table('expo_posts')
        ->addColumn('name','string', ['limit' => 255,'null' => false])
        ->addColumn('description', 'text', ['limit' => 4294967295,'default' => null,'null' => true])
        ->addColumn('push_flag', 'boolean', ['default' => false, 'null' => false])
        ->addColumn('modified', 'datetime', ['default' => null,'limit' => null,'null' => false])
        ->addColumn('created', 'datetime', ['default' => null,'limit' => null,'null' => false])
        ->create();
    }
    public function down(): void
    {
        $this->table('expo_posts')->drop()->save();
    }
}
