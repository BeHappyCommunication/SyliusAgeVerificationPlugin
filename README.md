# SyliusAgeVerificationPlugin
Provides a way to check customers age in Sylius.

# Installation-procedure
```bash
$ composer require behappy/age-verification-plugin
```

## Enable the plugin

```php
// in app/AppKernel.php
public function registerBundles() {
	$bundles = array(
		// ...
		new \BeHappy\SyliusAgeVerificationPlugin\BeHappySyliusAgeVerificationPlugin(),
	);
	// ...
}
```

```yml
#in app/config/config.yml
imports:
    ...
    - { resource: "@BeHappySyliusAgeVerificationPlugin/Resources/config/app/config.yml" }
```

## Front office
You'll now need to override registration form since the age isn't required by default by Sylius. To do so :

```twig
{# /app/Resources/SyliusShopBundle/views/Register/_form.html.twig #}
<h4 class="ui dividing header">{{ 'sylius.ui.personal_information'|trans }}</h4>
<div class="two fields">
    {{ form_row(form.firstName) }}
    {{ form_row(form.lastName) }}
</div>
<div class="two fields">
    {{ form_row(form.email) }}
    {{ form_row(form.birthday) }}
</div>
{{ form_row(form.phoneNumber) }}
{{ form_row(form.subscribedToNewsletter) }}
<h4 class="ui dividing header">{{ 'sylius.ui.account_credentials'|trans }}</h4>
{{ form_row(form.user.plainPassword.first) }}
{{ form_row(form.user.plainPassword.second) }}
```

This is an example, adapt it to your needs.

# That's it !
Now, everytime a customer will try to registrate, the birthday will be required, and must be over 18 (default)

Same for creating a customer in the BackOffice.

# Configuration
You can redefine the required age by overriding this parameter :

```yml
# in app/config.yml
parameters:
    ...
    be_happy.age_verification.minimal_age: 21
    ...
```

# Feel free to contribute
You can also ask your questions at the mail address in the composer.json mentioning this package.

# Other
You can also check our other packages (including Sylius plugins) at https://github.com/BeHappyCommunication
