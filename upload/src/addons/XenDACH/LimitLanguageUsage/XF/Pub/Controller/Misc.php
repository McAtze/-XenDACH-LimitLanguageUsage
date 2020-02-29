<?php

namespace XenDACH\LimitLanguageUsage\XF\Pub\Controller;

class Misc extends XFCP_Misc
{
	public function actionLanguage()
    {
        if ($this->request->exists('language_id'))
        {
            $visitor = \XF::visitor();

            $language = $this->em()->find('XF:Language', $this->filter('language_id', 'uint'));

            //$redirect = $this->getDynamicRedirect(null, true);

            if (!$language || (!$visitor->is_admin && !$language->xd_user_selectable))
            {
                //return $this->redirect($redirect);
                return $this->noPermission();
            }
        }

        return parent::actionLanguage();
    }
}
