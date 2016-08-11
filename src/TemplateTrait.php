<?php

namespace NAttreid\Latte;

use Nette\Application\Helpers;

trait TemplateTrait {

    /** @var string */
    private $templateDir;

    /**
     * Zmena adresare pro sablony
     * @param string $dir
     */
    protected function setViewDir($dir) {
        $this->templateDir = $dir;
    }

    /**
     * {@inheritdoc }
     */
    public function formatTemplateFiles() {
        if ($this->templateDir !== NULL) {
            $presenter = $this->templateDir;
        } else {
            list(, $presenter) = Helpers::splitName($this->getName());
        }
        $dir = dirname($this->getReflection()->getFileName());
        $dir = is_dir("$dir/templates") ? $dir : dirname($dir);
        return [
            "$dir/templates/$presenter/$this->view.latte",
            "$dir/templates/$presenter.$this->view.latte",
        ];
    }

    /**
     * {@inheritdoc }
     */
    public function formatLayoutTemplateFiles() {
        if (preg_match('#/|\\\\#', $this->layout)) {
            return [$this->layout];
        }
        if ($this->templateDir !== NULL) {
            $presenter = $this->templateDir;
        } else {
            list($module, $presenter) = Helpers::splitName($this->getName());
        }
        $layout = $this->layout ? $this->layout : 'layout';
        $dir = dirname($this->getReflection()->getFileName());
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
