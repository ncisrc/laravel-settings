# NCI Settings

## Installation :

> Note : Il est recommandé de séparer, par soucis de clarté, de séparer les sources des projets et sources des packages (exemple : sources/packages/mon-package).

```bash
# Au préalable
sudo apt-get install php8.2-mbstring
sudo apt-get install php8.2-xml
sudo apt-get install php8.2-sqlite3

# Clonez le projet
git clone git@github.com:ncisrc/laravel-settings.git

# Initialisez git flow
git flow init # validez les valeurs par défaut

# Installez les vendors
composer install

# Lancer les tests unitaires
composer test
ou
composer test-f ma_fonction_test

```

## Installation du package dans un projet :

Ajoutez le repository au fichier `composer.json` du projet
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ncisrc/laravel-settings.git"
        }
    ],
    "require": {
        "nci/settings": "master"
    },
    "script": {
        "post-install-cmd": [
           "rm -rf vendor/nci/settings/.git"
        ],
        "post-update-cmd": [
            "rm -rf vendor/nci/settings/.git"
        ]
    }
}
```
Installez les vendors
`composer install` ou `composer update`

OPTIONNEL - Ajouter le provider dans `config/app.php`

```php
/*
 * Package Service Providers...
 */
Nci\Settings\SettingsPackageServiceProvider::class,
```

Publiez le fichier de configuration
`sail artisan vendor:publish --provider="Nci\Settings\SettingsPackageServiceProvider"`

Champs disponibles dans le fichier de configuration :
- prefix => définit la chaîne de caractère se trouvant avant les routes disponibles, par défaut "ncisettings" (exemple: ncisettings/settings/user/1).
- middleware => tableau des middleware à appliquer avant toute requête, par défaut contient le middleware "web".

Lancez les migrations
`sail artisan migrate`

`Ajoutez le trait au model associé au settings`
```php
use Nci\Settings\Traits\HasSettings;
use HasSettings;
```

Routes disponibles

**Setting
- Get /settings
- Get /setting/{id}
- Put /setting/{id}

**SettingOptions**
- Get /setting/options

**SettingTypes**
- Get /setting/types

**UserSetting**
- Get /settings/user/{userId}
- Get /setting/{settingId}/user/{userId}
