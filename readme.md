# Rozšíření Latte pro Nette Framework
Nastavení v **config.neon**
```neon
extensions:
    - NAttreid\Latte\DI\LatteExtension
```

## Rozšíření
V **BasePresenter** přidáte
```php
use \NAttreid\Latte\TemplateTrait;
```

## Makra
### onLoad
Pro spuštení JS skriptu po asynchroním nahrání základních JS skriptů
```html
<script type="text/javascript">
    function somefunction() {
        jaavscript code ...
    }
    {onLoad somefunction}
</script>    
```

### Try
Zachytávání vyjímek v latte
```html
{try}
    {kriticka_funkce}
{/try}
```

### Panel
```html
{panel 'textToTranslate', dalsiNeprekladanyText, class => 'nameOfClass', id => 'nameOfId'}
    html kod ...
{/panel}
```

### View
```html
{view class => 'nameOfClass', id => 'nameOfId'}
    html kod ...
{/view}
```

## Latte Filtry
### Lokalizovane číslo
```html
{$number|localeNumber}
```

### Procenta
```html
{$number|percent:$total:$decimal}
```

### Frekvence
```html
{$cpu|frequency}
```

### Velikost soborů
```html
{$fileSize|size:$decimal:$binary}
```

### Lokalizovaný čas
```html
{$datetime|localeDateTime}
```


### Lokalizovaný čas bez sekund
```html
{$datetime|localeDateWithTime}
```

### Lokalizované datum
```html
{$datetime|localeDate}
```

### Den v týdnu
```html
{$day|day}
```

### Zkrácený den v týdnu
```html
{$day|shortDay}
```

### Měsíc v roce
```html
{$month|month}
```

### Zkrácený měsíc v roce
```html
{$month|shortMonth}
```

### Prevod do json
```html
{$data|json}
```