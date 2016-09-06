<?php

namespace NAttreid\Latte\Macro;

/**
 * Html makra latte
 *
 * @author Attreid <attreid@gmail.com>
 */
class Html extends \Latte\Macros\MacroSet
{

	public static function install(\Latte\Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('panel', [$me, 'macroPanel'], [$me, 'macroEndPanel']);
		$me->addMacro('view', [$me, 'macroView'], [$me, 'macroEndView']);
	}

	/**
	 * Panel
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 * @throws \Latte\CompileException
	 */
	public function macroPanel(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		$args = explode(',', $node->args);
		$data = new \stdClass;
		$data->text = '';
		$data->toTranslate = NULL;

		foreach ($args as $arg) {
			if (strpos($arg, '=>') !== false) {
				list($object, $value) = array_map('trim', explode('=>', $arg));
				$data->$object = $value;
			} else {
				if ($data->toTranslate === NULL) {
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
                            ' . (empty($data->toTranslate) ?
				'if(isset($this->blockQueue["title"])){$this->renderBlock("title", get_defined_vars());}' :
				'echo $template->translate("' . $data->toTranslate . '") . "' . $data->text . '";') . '
                  echo "</h1>
                    </header>
                <div class=\"content\">";');
	}

	/**
	 * Konec panelu
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 */
	public function macroEndPanel(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		return 'echo "</div></div>"';
	}

	/**
	 * Pohled
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 * @throws \Latte\CompileException
	 */
	public function macroView(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		$args = explode(',', $node->args);
		$data = new \stdClass;

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
	 * @param \Latte\MacroNode $node
	 * @param \Latte\PhpWriter $writer
	 * @return string
	 */
	public function macroEndView(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
	{
		return 'echo "</div>"';
	}

}
