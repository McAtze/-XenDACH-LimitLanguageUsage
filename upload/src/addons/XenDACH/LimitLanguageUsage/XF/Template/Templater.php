<?php

namespace XenDACH\LimitLanguageUsage\XF\Template;

class Templater extends XFCP_Templater
{
    public function fnCopyright($templater, &$escape)
    {
        $copyright = parent::fnCopyright($templater, $escape);

        if(!file_exists(\XF::getRootDirectory() . '/src/addons/XenDACH/FreeCopyright.dat'))
        {
            if(!\XF::app()->offsetExists('XenDACHFreeCopyright'))
            {
                $copyright .= ' | <a href="https://www.xentutorials.com/" title="XenTutorials Add-ons" target="_blank" class="u-concealed">Certain Add-Ons</a> by XenTutorials';
                \XF::app()->offsetSet('XenDACHFreeCopyright', true);
            }
        }

        return $copyright;
    }
}
if(false)
{
    class XFCP_Templater extends \XF\Template\Templater {}
}