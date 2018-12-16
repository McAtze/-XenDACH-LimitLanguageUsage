<?php

namespace XenDACH\LimitLanguageUsage\XF\Pub\Controller;

class Account extends XFCP_Account
{
	protected function preferencesSaveProcess(\XF\Entity\User $visitor)
    {
        $form = parent::preferencesSaveProcess($visitor);

        $input = $this->filter([
            'user' => [
                'language_id' => 'uint'
            ]
        ]);

        $language = $this->em()->find('XF:Language', $input['user']['language_id']);

        if (!$language->xd_user_selectable)
        {
            $form->logError(\XF::phrase('xd_invalid_style'));
        }

        return $form;
    }
}
