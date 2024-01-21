###################
#     l i n t     #
###################
phpcs:
	~/.composer/vendor/bin/php-cs-fixer fix

twigcs:
	~/.composer/vendor/bin/twigcs templates tests/templates
	bin/console lint:twig templates tests/templates

phpstan:
	~/.composer/vendor/bin/phpstan

yaml:
	bin/console lint:yaml tests/config
	bin/console lint:yaml phpstan.dist.neon

composer:
	composer validate --strict

####################
#  P H P U N I T   #
####################
test: init-test
	bin/phpunit

cover-text: init-test
	bin/phpunit --coverage-text

cover: init-test
	bin/phpunit --coverage-html var/coverage

init-test:
#	cp var/database/empty.db var/database/test.db

#####################
#  D A T A B A S E  #
#####################
database:
	touch var/database/dev.db
	rm var/database/dev.db
	touch var/database/dev.db
	bin/console doctrine:migration:migrate --quiet
	cp var/database/dev.db  var/database/empty.db
#	bin/console doctrine:fixture:load --quiet
