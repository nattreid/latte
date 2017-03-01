<?php

declare(strict_types = 1);

namespace NAttreid\Latte\Macro;

use Latte\CompileException;
use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;
use stdClass;

/**
 * Html makra latte
 *
 * @author Attreid <attreid@gmail.com>
 */
class Html extends MacroSet
{

	public static function install(Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('panel', [$me, 'macroPanel'], [$me, 'macroEndPanel']);
		$me->addMacro('view', [$me, 'macroView'], [$me, 'macroEndView']);
	}

	/**
	 * Panel
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
	public function macroPanel(MacroNode $node, PhpWriter $writer): string
	{
		$args = explode(',', $node->args);
		$data = new stdClass;
		$data->text = '';
		$data->toTranslate = null;

		foreach ($args as $arg) {
			if (strpos($arg, '=>') !== false) {
				list($object, $value) = array_map('trim', explode('=>', $arg));
				$data->$object = $value;
			} else {
				if ($data->toTranslate === null) {
					$data->toTranslate = str_replace('"', '', trim($arg));
				} else {
					$data->text .= ' ' . trim($arg);
				}
			}
		}
		return $writer->write('
            echo "<div' . (!empty($data->id) ? ' id=\"' . $data->id . '\"' : '') . ' class=\"panel-container' . (!empty($data->class) ? ' ' . $data->class : '') . '\">
                    <header>
                        <h1>";
                            ' . (
			empty($data->toTranslate) ?
				'if(isset($this->blockQueue["title"])){$this->renderBlock("title", get_defined_vars());}'
				: 'echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, "' . $data->toTranslate . '")). "' . $data->text . '";'
			) . '
                  		echo "</h1>
                    </header>
                <div class=\"content\">";');
	}

	/**
	 * Konec panelu
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 */
	public function macroEndPanel(MacroNode $node, PhpWriter $writer): string
	{
		return 'echo "</div></div>"';
	}

	/**
	 * Pohled
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
	public function macroView(MacroNode $node, PhpWriter $writer): string
	{
		$args = explode(',', $node->args);
		$data = new stdClass;

		foreach ($args as $arg) {
			if (strpos($arg, '=>') !== false) {
				list($object, $value) = array_map('trim', explode('=>', $arg));
				$data->$object = $value;
			}
		}
		return $writer->write('echo 
            "<div' . (!empty($data->id) ? ' id=\"' . $data->id . '\"' : '') . ' class=\"view-container' . (!empty($data->class) ? ' ' . $data->class : '') . '\">"');
	}

	/**
	 * Konec pohledu
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 */
	public function macroEndView(MacroNode $node, PhpWriter $writer): string
	{
		return 'echo "</div>"';
	}

}
