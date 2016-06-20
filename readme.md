# Rozšíření Latte pro Nette Framework
Nastavení v **config.neon**
```neon
extensions:
    latteExtension: NAttreid\Latte\DI\LatteExtension
```

## Rozšíření
V **BasePresenter** přidáte
```php
use \NAttreid\Latte\Template;
```