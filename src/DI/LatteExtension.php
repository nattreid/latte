<?php

namespace NAttreid\Latte\DI;

/**
 * Rozsireni
 * 
 * @author Attreid <attreid@gmail.com>
 */
class LatteExtension extends \Nette\DI\CompilerExtension {

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $builder->removeDefinition('latte.templateFactory');
        $builder->addDefinition('latte.templateFactory')
                ->setClass('NAttreid\Latte\TemplateFactory');
    }

    public function beforeCompile() {
        $builder = $this->getContainerBuilder();
        $builder->getDefinition('latte.latteFactory')
                ->addSetup('NAttreid\Latte\Macro\Html::install(?->getCompiler())', ['@self'])
                ->addSetup('NAttreid\Latte\Macro\Helper::install(?->getCompiler())', ['@self'])
                ->addSetup('addFilter', ['NAttreid\Latte\Filters', 'common']);
    }

}
