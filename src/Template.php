<?php

namespace NAttreid\Latte;

trait Template {

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
        $name = $this->getName();
        $presenter = $this->templateDir !== NULL ? $this->templateDir : substr($name, strrpos(':' . $name, ':'));
        $dir = dirname($this->getReflection()->getFileName());
        $dir = is_dir("$dir/templates") ? $dir : dirname($dir);
        return array(
            "$dir/templates/$presenter/$this->view.latte",
            "$dir/templates/$presenter.$this->view.latte",
        );
    }

    /**
     * {@inheritdoc }
     */
    public function formatLayoutTemplateFiles() {
        $name = $this->getName();
        $presenter = $this->templateDir !== NULL ? $this->templateDir : substr($name, strrpos(':' . $name, ':'));
        $layout = $this->layout ? $this->layout : 'layout';
        $dir = dirname($this->getReflection()->getFileName());
        $dir = is_dir("$dir/templates") ? $dir : dirname($dir);
        $list = array(
            "$dir/templates/$presenter/@$layout.latte",
            "$dir/templates/$presenter.@$layout.latte",
        );
        do {
            $list[] = "$dir/templates/@$layout.latte";
            $dir = dirname($dir);
        } while ($dir && ($name = substr($name, 0, strrpos($name, ':'))));
        return $list;
    }

}
