# NCI Settings

## Installation :

> Note : Il est recommandé de séparer, par soucis de clarté, de séparer les sources des projets et sources des packages (exemple : souces/packages/mon-package).

```bash
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

> Note : TODO

```bash
// TODO

# Publish le fichier de configuration
sail artisan vendor:publish --provider="Nci\SettingsPackage\SettingsPackageServiceProvider" --tag="config"
# Champs disponibles dans le fichier de configuration :
# prefix => définit la chaîne de caractère se trouvant avant les routes disponnibles, par défaut "ncisettings" (exemple: ncisettings/settings/user/1).
# middleware => array des middleware à appliquer avant toutes requête, par défaut contient le middleware "web".

# Ajouté le trait au model User
use Nci\SettingsPackage\Traits\HasSettings;
use HasSettings;

```