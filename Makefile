CS_FIXER = php vendor/bin/php-cs-fixer fix --config=.php_cs -v --using-cache=no --diff --diff-format=udiff --ansi
PSALM = vendor/bin/psalm --threads=1 --no-cache --find-dead-code=always --show-info=false --config=.psalm/config.xml
PHPUNIT = php vendor/bin/phpunit

PHP_FILES_DIFF = $(shell git diff --name-only --diff-filter=ACMRTUXB $(1) | grep -iE \.php$)
CS_FIXER_TEST = if test "$(1)" ; then $(CS_FIXER) --dry-run $(1) ; else echo "Nothing to fix" ; fi
CS_FIXER_FIX = if test "$(1)" ; then $(CS_FIXER) $(1) ; else echo "Nothing to fix" ; fi

LOGS_DIR = logs
CLOVER_FILE = $(LOGS_DIR)/clover.xml
COVERAGE_REPORT_DIR = $(LOGS_DIR)/report
PSALM_REPORT_FILE = $(LOGS_DIR)/psalm.local.json

.PHONY: all
all: clean install test lint

.PHONY: lint
lint: psalm cs-test

.PHONY: clean
clean:
	rm -dfR $(LOGS_DIR)/*

.PHONY: install
install:
	composer install -n --no-suggest

.PHONY: cs-test
cs-test:
	$(call CS_FIXER_TEST,$(call PHP_FILES_DIFF,"origin/master"))

.PHONY: cs-fix
cs-fix:
	$(call CS_FIXER_FIX,$(call PHP_FILES_DIFF,"origin/master"))

.PHONY: cs-test-all
cs-test-all:
	$(CS_FIXER) --dry-run

.PHONY: cs-fix-all
cs-fix-all:
	$(CS_FIXER)

.PHONY: psalm
psalm:
	$(PSALM)

.PHONY: psalm-report
psalm-report:
	$(PSALM) --report-show-info=false --report=$(PSALM_REPORT_FILE)

.PHONY: test
test:
	$(PHPUNIT)

.PHONY: show-coverage
show-coverage:
	$(PHPUNIT) --coverage-text=php://stdout

.PHONY: report-coverage
report-coverage:
	$(PHPUNIT) --coverage-clover $(CLOVER_FILE)

.PHONY: report-html-coverage
report-html-coverage:
	$(PHPUNIT) --coverage-html $(COVERAGE_REPORT_DIR)
