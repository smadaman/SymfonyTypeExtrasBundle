Smada SymfonyTypeExtrasBundle
---------------------------

This bundle includes additional Field Types for Symfony Forms. they include:
 - "input_boxes" form field type. This input is great for account numbers, abns etc where you want 1 input box per number but the transformer returns the value as a string so it is easy to deal with.

Installation
---------------------------

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest version of this bundle:
NOTE: This version is not entirely stable yet

```bash
$ composer require smada/symfony-type-extras-bundle "dev-master"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Smada\SymfonyTypeExtrasBundle\SmadaSymfonyTypeExtrasBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Add in the field template
---------------------------------

Add in the template so the field knows how to be rendered. You can override this with your own rendering template by adding your own class and changing the value of this setting

```yml
# app/config/config.yml
twig:
    form:
        resources:
            - SmadaSymfonyTypeExtrasBundle:Form:fields.html.twig
```

Step 4: Add Resource Assets
---------------------------

Add in the css and js as assets in your assetic config.

```yml
# app/config/config.yml
assetic:
    use_controller: false
    assets:
        smada_types_css:
            inputs:
                - '@SmadaSymfonyTypeExtrasBundle/Resources/public/css/input-boxes.css'
        smada_types_js:
            inputs:
                - '@SmadaSymfonyTypeExtrasBundle/Resources/public/js/input-boxes.js'
```

Step 5: Reference Assets
---------------------------

- Now you will need to reference it in your layout
```twig
{% stylesheets '@smada_types_css' %}
    <link rel="stylesheet" href="{{ asset_url }}"/>
{% endstylesheets %}

{% javascripts '@smada_types_js' %}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

- Now dump your assetic
```bash
$ php app/console assetic:dump
```

Examples
--------

 - Input Boxes

```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('accountNumber', 'input_boxes', ['boxes' => 10])
}
```
