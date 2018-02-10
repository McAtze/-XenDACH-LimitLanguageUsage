<?php

namespace XenDACH\LimitLanguageUsage\XF\Entity;

class Language extends XFCP_Language
{
    protected function verifyXdUserSelectable($value)
    {
        if (!$value) {
            $defaultLanguage = $this->app()->options()->defaultLanguageId;
            if ($this->language_id == $defaultLanguage) {
                $this->error(\XF::phrase('xd_it_is_not_possible_to_prevent_users_selecting_the_default_language_limitLanguageUsage'), 'xd_user_selectable');

                return false;
            }
        }

        return true;
    }
}
