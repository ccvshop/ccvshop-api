# QA Framework toevoegen aan bestaand project

Nieuwe projecten zullen deze changes allemaal al hebben. Voor bestaande projecten zijn de onderstaande changes nodig. 

# Composer packages
Deze packages dienen geinstalleerd te worden via Composer. Tevens moeten er een aantal scripts worden toegevoegd

## Packages to install 
```shell

composer require --dev \
  barryvdh/laravel-ide-helper \
  friendsofphp/php-cs-fixer \
  larastan/larastan \
  phpmd/phpmd \
  slevomat/coding-standard \
  squizlabs/php_codesniffer

composer require sentry/sentry-laravel
```

## Scripts to add
Deze scripts dienen in de [composer.json](../composer.json) te worden toegevoegd. Hiermee kan je de tests lokaal aanroepen, maar gitlab-ci maakt hier ook gebruik van. 
```json
{
    "scripts": {
        "checkcode": "composer phpcs; composer php-cs-fixer; composer phpmd; composer phpstan",
        "fixcode": "composer phpcs-fix; composer php-cs-fixer-fix",
        "phpcs": "vendor/bin/phpcs --standard=./ci-cd/config/phpcs/phpcs.xml --no-cache app/ bootstrap/ config/ routes/ tests/",
        "php-cs-fixer": "vendor/bin/php-cs-fixer --config=./ci-cd/config/php-cs-fixer/php-cs-fixer.dist.php check -vv",
        "phpmd": "vendor/bin/phpmd app/ bootstrap/ config/ routes/ tests/ text ./ci-cd/config/phpmd/ruleset.phpmd.xml",
        "phpstan": "vendor/bin/phpstan analyse -c ci-cd/config/phpstan/phpstan.neon --ansi",
        "phpcs-fix": "vendor/bin/phpcbf --standard=./ci-cd/config/phpcs/phpcs.xml --no-cache app/ bootstrap/ config/ routes/ tests/",
        "php-cs-fixer-fix": "vendor/bin/php-cs-fixer --config=./ci-cd/config/php-cs-fixer/php-cs-fixer.dist.php fix -vv"
    }
}
```

# gitlab-ci.yml
Deze stages en includes dienen minimaal toegevoegd te worden aan de [.gitlab-ci.yml](../.gitlab-ci.yml). 


```yaml
stages:
  - verify
  - build
  - deploy

include:
  - '/ci-cd/qa-tooling-ci.yml'
  - '/ci-cd/deploy-ci.yml'

```

# Sonar
De [sonar-project.properties](../sonar-project.properties) is aanwezig. 
Hier dient enkel de juiste `sonar.projectKey` te worden toegevoegd. 

# Sentry
De config voor Sentry is gemaakt en in de [.env](../.env) moet de `SENTRY_LARAVEL_DSN` worden aangepast.  
