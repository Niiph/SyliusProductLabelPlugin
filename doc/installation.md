## Installation

```bash
composer require niiph/product-label-plugin
```

Add plugin dependencies to your `config/bundles.php` file:

```php
return [
    ...
    
    Niiph\SyliusProductLabelPlugin\NiiphSyliusProductLabelPlugin::class  => ['all' => true]
];
```

Import required config in your `config/packages/_sylius.yaml` file:

```yaml
# config/packages/_sylius.yaml

imports:
  ...

  - { resource: "@NiiphSyliusProductLabelPlugin/config/config.yaml" }
```

Import routing in your `config/routes.yaml` file:

```yaml

# config/routes.yaml
...

niiph_product_label_plugin:
    resource: "@NiiphSyliusProductLabelPlugin/config/routes/routes.yaml"
```

Add trait and interface to your Product entity class and make sure to initialise `label` collection in constructor

```php
<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Niiph\SyliusProductLabelPlugin\Entity\HasLabelsInterface;
use Niiph\SyliusProductLabelPlugin\Entity\LabelsTrait;
use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct implements HasLabelsInterface
{
    use LabelsTrait;
    
    public function __construct()
    {
        parent::__construct();
        $this->initialiseLabelCollection();
    }
}
```

Add webpack mapping:

1. Add new entries to your `webpack.config.js`
```js
// ./webpack.config.js

// Shop config
    .addEntry('niiph-producer-label-shop', './vendor/niiph/sylius-product-label-plugin/assets/shop/entry.js')

// Admin config
    .addEntry('niiph-producer-label-admin', './vendor/niiph/sylius-product-label-plugin/assets/admin/entry.js')
```

2. Add encore functions to your templates

```twig
{# @SyliusShopBundle/_scripts.html.twig #}
{{ encore_entry_script_tags('niiph-producer-label-shop', null, 'shop') }}

{# @SyliusShopBundle/_styles.html.twig #}
{{ encore_entry_link_tags('niiph-producer-label-shop', null, 'shop') }}

{# @SyliusAdminBundle/_scripts.html.twig #}
{{ encore_entry_script_tags('niiph-producer-label-admin', null, 'admin') }}

{# @SyliusAdminBundle/_styles.html.twig #}
{{ encore_entry_link_tags('niiph-producer-label-admin', null, 'admin') }}
```


Finish the installation by updating the database schema:

```sh
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate
bin/console assets:install
bin/console sylius:theme:assets:install
```

and 
```sh
yarn encore dev
```

Finally, add template
```twig
{% include '@NiiphSyliusProductLabelPlugin/Shop/Product/_labels.html.twig' %}
```
in proper place (originally at `SyliusShopBundle/Product/_box.html.twig`):
```twig
{% import "@SyliusShop/Common/Macro/money.html.twig" as money %}

{{ sonata_block_render_event('sylius.shop.product.index.before_box', {'product': product}) }}

<div class="ui fluid card product">
    <a href="{{ path('sylius_shop_product_show', {'slug': product.slug, '_locale': product.translation.locale}) }}" class="blurring dimmable image">
        <div class="ui dimmer">
            <div class="content">
                <div class="center">
                    <div class="ui inverted button">{{ 'sylius.ui.view_more'|trans }}</div>
                </div>
            </div>
        </div>
        {% include '@NiiphSyliusProductLabelPlugin/Shop/Product/_labels.html.twig' %}
        {% include '@SyliusShop/Product/_mainImage.html.twig' with {'product': product} %}
    </a>
    <div class="content">
        <a href="{{ path('sylius_shop_product_show', {'slug': product.slug, '_locale': product.translation.locale}) }}" class="header sylius-product-name">{{ product.name }}</a>
        {% if not product.variants.empty() %}
            <div class="sylius-product-price">{{ money.calculatePrice(product|sylius_resolve_variant) }}</div>
        {% endif %}
    </div>
</div>

{{ sonata_block_render_event('sylius.shop.product.index.after_box', {'product': product}) }}
```
