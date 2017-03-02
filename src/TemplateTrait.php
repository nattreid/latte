<?php

declare(strict_types = 1);

namespace NAttreid\Latte;

use Nette\Application\Helpers;

trait TemplateTrait
{

	/** @var string */
	private $templateDir;

	/** @var string */
	private $templatePath;

	/**
	 * Zmena pro sablony v ramci slozky templates
	 * @param string $dir
	 */
	protected function setViewDir($dir = null)
	{
		$this->templateDir = $dir;
	}

	/**
	 * Zmena cestyk adresari pro sablony
	 * @param string $path
	 */
	protected function setViewPath($path = null)
	{
		$this->templatePath = $path;
	}

	/**
	 * {@inheritdoc }
	 */
	public function formatTemplateFiles()
	{
		if ($this->templateDir !== null) {
			$presenter = $this->templateDir;
		} else {
			list(, $presenter) = Helpers::splitName($this->getName());
		}
		if ($this->templatePath !== null) {
			$dir = $this->templatePath;
		} else {
			$dir = dirname($this->getReflection()->getFileName());
		}
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);
		return [
			"$dir/templates/$presenter/$this->view.latte",
			"$dir/templates/$presenter.$this->view.latte",
		];
	}

	/**
	 * {@inheritdoc }
	 */
	public function formatLayoutTemplateFiles()
	{
		if ($this->layout != null && preg_match('#/|\\\\#', $this->layout)) {
			return [$this->layout];
		}
		if ($this->templateDir !== null) {
			$presenter = $this->templateDir;
			$module = null;
		} else {
			list($module, $presenter) = Helpers::splitName($this->getName());
		}
		$layout = $this->layout ? $this->layout : 'layout';
		if ($this->templatePath !== null) {
			$dir = $this->templatePath;
		} else {
			$dir = dirname($this->getReflection()->getFileName());
		}
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);
		$list = [
			"$dir/templates/$presenter/@$layout.latte",
			"$dir/templates/$presenter.@$layout.latte",
		];
		do {
			$list[] = "$dir/templates/@$layout.latte";
			$dir = dirname($dir);
		} while ($dir && $module && (list($module) = Helpers::splitName($module)));
		return $list;
	}

}
