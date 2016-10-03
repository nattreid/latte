<?php

namespace NAttreid\Latte\DI;

use NAttreid\Latte\Filters;
use NAttreid\Latte\Macro\Helper;
use NAttreid\Latte\Macro\Html;

/**
 * Rozsireni
 *
 * @author Attreid <attreid@gmail.com>
 */
class LatteExtension extends \Nette\DI\CompilerExtension
{

	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$builder->getDefinition('latte.latteFactory')
			->addSetup(Html::class . '::install(?->getCompiler())', ['@self'])
			->addSetup(Helper::class . '::install(?->getCompiler())', ['@self'])
			->addSetup('addFilter', [null, Filters::class . '::common']);
	}

}
