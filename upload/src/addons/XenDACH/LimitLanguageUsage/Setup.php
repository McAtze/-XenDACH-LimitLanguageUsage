<?php

namespace XenDACH\LimitLanguageUsage;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->alterTable('xf_language', function (\XF\Db\Schema\Alter $table) {
            $table->addColumn('xd_user_selectable', 'bool')->setDefault(1);
        });
    }

    public function upgrade1000031Step1()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->alterTable('xf_language', function (\XF\Db\Schema\Alter $table) {
            $table->renameColumn('user_selectable', 'xd_user_selectable')->type('bool')->setDefault(1);
        });

        $schemaManager->alterTable('xf_language', function (\XF\Db\Schema\Alter $table) {
//            $table->changeColumn('xd_user_selectable', 'bool')->setDefault(1);
        });
    }

    public function uninstallStep1()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->alterTable('xf_language', function (\XF\Db\Schema\Alter $table) {
            $table->dropColumns(['xd_user_selectable']);
        });
    }
}
