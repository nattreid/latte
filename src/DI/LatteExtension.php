<?php

declare(strict_types=1);

namespace NAttreid\Latte\DI;

use NAttreid\Latte\Filters;
use NAttreid\Latte\Macro\Helper;
use NAttreid\Latte\Macro\Html;
use Nette\DI\CompilerExtension;

/**
 * Rozsireni
 *
 * @author Attreid <attreid@gmail.com>
 */
class LatteExtension extends CompilerExtension
{

	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();
		$builder->getDefinition('latte.latteFactory')
			->addSetup(Html::class . '::install(?->getCompiler())', ['@self'])
			->addSetup(Helper::class . '::install(?->getCompiler())', ['@self'])
			->addSetup('addFilter', [null, Filters::class . '::common']);
	}

}
