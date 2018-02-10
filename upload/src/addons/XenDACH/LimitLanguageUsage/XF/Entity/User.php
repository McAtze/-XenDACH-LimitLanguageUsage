<?php

namespace XenDACH\LimitLanguageUsage\XF\Entity;

class User extends XFCP_User
{
    public function canChangeLanguage(&$error = null)
    {
        $languages = 0;
        foreach ($this->app()->container('language.cache') as $language) {
            if (!empty($language['xd_user_selectable'])) {
                $languages++;
            }
        }

        if ($languages > 1) {
            return true;
        }

        return false;
    }
}
