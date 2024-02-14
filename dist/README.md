# NCI Settings

## Installation :

> Note : Il est recommandé de séparer, par soucis de clarté, de séparer les sources des projets et sources des packages (exemple : souces/packages/mon-package).

```bash
# Au préalable
sudo apt-get install php8.2-mbstring
sudo apt-get install php8.2-xml
sudo apt-get install php8.2-sqlite3

# Clonez le projet
git clone git@git-cloud.nci.fr:laravel-package/settings.git

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

```bash
# Ajoutez le repository au composer.json du projet
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://gitlab+deploy-token-1:Nqx129U7QWBZziNThYJM@git-cloud.nci.fr/laravel-package/settings.git"
        }
    ],
    "require": {
        "nci/settings": "master"
    }
}

# Installez les vendors
composer install ou composer update

# Ajouter le provider dans "config/app.php" - OPTIONNEL
/*
* Package Service Providers...
*/
Nci\Settings\SettingsPackageServiceProvider::class,

# Publish le fichier de configuration
sail artisan vendor:publish --provider="Nci\Settings\SettingsPackageServiceProvider"
# Champs disponibles dans le fichier de configuration :
# prefix => définit la chaîne de caractère se trouvant avant les routes disponnibles, par défaut "ncisettings" (exemple: ncisettings/settings/user/1).
# middleware => array des middleware à appliquer avant toutes requête, par défaut contient le middleware "web".

# Lancez les migrations
sail artisan migrate

# Ajoutez le trait au model User
use Nci\Settings\Traits\HasSettings;
use HasSettings;

# Routes disponibles

// Setting
Get /settings
Get /setting/{id}
Put /setting/{id}

// SettingOptions
Get /setting/options

// SettingTypes
Get /setting/types

// UserSetting
Get /settings/user/{userId}
Get /setting/{settingId}/user/{userId}

```
