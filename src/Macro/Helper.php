<?php

namespace NAttreid\Latte\Macro;

/**
 * Helper Makra
 *
 * @author Attreid <attreid@gmail.com>
 */
class Helper extends \Latte\Macros\MacroSet
{

	public static function install(\Latte\Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('onLoad', [$me, 'macroOnLoad']);
		$me->addMacro('try', 'try {', '} catch (\Exception $e) {}');
		$me->addMacro('exist', [$me, 'macroExist'], [$me, 'macroEndExist']);
	}

	/**
	 * onLoad pro javascript
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 * @throws \Latte\CompileException
	 */
	public function macroOnLoad(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		if ($node->args == '') {
			throw new \Latte\CompileException('Missing function name argument in {onLoad} macro.');
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
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 * @throws \Latte\CompileException
	 */
	public function macroExist(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		if ($node->args == '') {
			throw new \Latte\CompileException('Missing component name argument in {exist} macro.');
		}
		return $writer->write('
            $component= $_control->getComponent("' . $node->args . '", false);
            if($component !== null) {
        ');
	}

	/**
	 * Konec Exist helperu
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 * @throws \Latte\CompileException
	 */
	public function macroEndExist(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		return '}';
	}

}
