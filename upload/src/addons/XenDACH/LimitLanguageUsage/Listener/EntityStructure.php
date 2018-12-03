<?php

namespace XenDACH\LimitLanguageUsage\Listener;

use XF\Mvc\Entity\Entity;

class EntityStructure
{
    public static function xfLanguage(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->columns['xd_user_selectable'] = [
            'type' => Entity::BOOL,
            'default' => true,
        ];
    }
}