<?php
declare(strict_types=1);

use BaserCore\Database\Migration\BcMigration;

class ExpoPushs extends BcMigration
{
    public function up()
    {
        $this->table('expo_pushs')
            ->addColumn('token', 'string', ['limit' => 255,'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null,'limit' => null,'null' => false])
            ->addColumn('created', 'datetime', ['default' => null,'limit' => null,'null' => false])
            ->create();
    }
    public function down(): void
    {
        $this->table('expo_pushs')->drop()->save();
    }
}