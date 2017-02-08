# Shopify Forms Bundle (Embed)

## Installation

**Install With Composer**

```json
{
   "require": {
       "sturple/shopify-partner-store": "dev-master"
   }
}

```

and then execute

```json
$ composer update
```


## Configuration

**Add to ```app/AppKernel.php``` file**

```php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            ...
             new Fgms\PartnerStoreBundle\FgmsPartnerStoreBundle();
        ]
    }
}

```

The following configuration options may/must be set in `config.yml`:

```yaml
fgms_partner_store:
    api_key:            # API key for Shopify
    secret:             # Secret for Shopify
```

## Shopify App Configuration

The bundle specifies the following routes which must be known to configure as a Shopify App:

- **Install:** `/install`
- **OAuth:** `/auth`
- **Support:** `/suport`
- **Home:** `/`

To setup a Shopify proxy for form submission point the proxy at `/submit`.  The unique code for the form to submit to should be appended to the Shopify proxy link.

