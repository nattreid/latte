<?php

declare(strict_types = 1);

namespace NAttreid\Latte\Macro;

use Latte\CompileException;
use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;

/**
 * Helper Makra
 *
 * @author Attreid <attreid@gmail.com>
 */
class Helper extends MacroSet
{

	public static function install(Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('onLoad', [$me, 'macroOnLoad']);
		$me->addMacro('try', 'try {', '} catch (\Exception $e) {}');
		$me->addMacro('exist', [$me, 'macroExist'], [$me, 'macroEndExist']);
	}

	/**
	 * onLoad pro javascript
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
	public function macroOnLoad(MacroNode $node, PhpWriter $writer): string
	{
		if ($node->args == '') {
			throw new CompileException('Missing function name argument in {onLoad} macro.');
		}
		return $writer->write('
            if($presenter->isAjax()) {
                echo "' . $node->args . '();";
            }else{
                echo "if (window.addEventListener) {
                    window.addEventListener(\'load\', ' . $node->args . ', false);
                } else if (window.attachEvent) {
                    window.attachEvent(\'onload\', ' . $node->args . ');
                } else {
                    window.onload = ' . $node->args . ';
                }";
            }');
	}

	/**
	 * Existuje komponenta
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
	public function macroExist(MacroNode $node, PhpWriter $writer): string
	{
		if ($node->args == '') {
			throw new CompileException('Missing component name argument in {exist} macro.');
		}
		return $writer->write('
            $component= $_control->getComponent("' . $node->args . '", false);
            if($component !== null) {
        ');
	}

	/**
	 * Konec Exist helperu
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
	public function macroEndExist(MacroNode $node, PhpWriter $writer): string
	{
		return '}';
	}

}
