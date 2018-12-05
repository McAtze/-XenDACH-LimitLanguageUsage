<?php

namespace XenDACH\LimitLanguageUsage\XF\Admin\Controller;

class Language extends XFCP_Language
{
    protected function languageSaveProcess(\XF\Entity\Language $language)
    {
        $form = parent::languageSaveProcess($language);

        if (!$this->filter('xd_user_selectable', 'bool') && $language->language_id == $this->options()->defaultLanguageId)
        {
            $form->logError(\XF::phrase('xd_it_is_not_possible_to_prevent_users_selecting_the_default_language_limitLanguageUsage'));
        }
        else
        {
            $form->setup(function() use ($language) {
                $language->xd_user_selectable = $this->filter('xd_user_selectable', 'bool');
            });
        }

        return $form;
    }

    public function actionToggle()
    {
        $input = $this->filter([
            'default_language_id' => 'int',
            'xd_user_selectable' => 'array'
        ]);

        $languageDefault = $this->assertLanguageExists($input['default_language_id']);
        if (!$languageDefault->xd_user_selectable) {
            return $this->error(\XF::phrase('xd_it_is_not_possible_to_prevent_users_selecting_the_default_language_limitLanguageUsage'));
        }

        foreach ($input['xd_user_selectable'] as $key => $value)
        {
            $languageSelectable = $this->assertLanguageExists($key);
            if ($languageSelectable->language_id == $languageDefault->language_id && !$value)
                return $this->error(\XF::phrase('xd_it_is_not_possible_to_prevent_users_selecting_the_default_language_limitLanguageUsage'));
        }

        parent::actionToggle();

        /** @var \XF\ControllerPlugin\Toggle $plugin */
        $plugin = $this->plugin('XF:Toggle');
        return $plugin->actionToggle('XF:Language', 'xd_user_selectable');
    }
}