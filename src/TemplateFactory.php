<?php

namespace NAttreid\Latte;

/**
 * {@inheritdoc }
 */
class TemplateFactory extends \Nette\Bridges\ApplicationLatte\TemplateFactory {

    /**
     * {@inheritdoc }
     */
    public function createTemplate(\Nette\Application\UI\Control $control = NULL) {
        $template = parent::createTemplate($control);
        $template->addFilter(NULL, '\NAttreid\Latte\Filters::common');
        return $template;
    }

}
