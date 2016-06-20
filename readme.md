# Rozšíření Latte pro Nette Framework
Nastavení v **config.neon**
```neon
services:
    latte.templateFactory: NAttreid\Latte\TemplateFactory
```
a přidání maker
```neon
latte:
    macros:
        - NAttreid\Latte\Macro\Html
        - NAttreid\Latte\Macro\Helper
```

## Rozšíření
V **BasePresenter** přidáte
```php
use \NAttreid\Latte\Template;
```