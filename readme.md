# Rozšíření Latte pro Nette Framework
Nastavení v **config.neon**
```neon
services:
    latte.templateFactory: NAttreid\Latte\TemplateFactory
```

## Rozšíření
V **BasePresenter** přidáte
```php
use \NAttreid\Latte\Template;
```