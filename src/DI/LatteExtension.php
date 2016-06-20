<?php

namespace NAttreid\Latte\DI;

/**
 * Nastaveni Latte
 * 
 * @author Attreid <attreid@gmail.com>
 */
class LatteExtension extends \Nette\DI\CompilerExtension {

    public function loadConfiguration() {
        $this->getConfig($this->loadFromFile(__DIR__ . '/latte.neon'));
    }

}
