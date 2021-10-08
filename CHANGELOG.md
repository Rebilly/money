# Change Log
All notable changes to this project will be documented in this file
using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.
This project adheres to [Semantic Versioning](http://semver.org/).

<!--
Types of changes

Added - for new features.
Changed - for changes in existing functionality.
Deprecated - for soon-to-be removed features.
Removed - for now removed features.
Fixed - for any bug fixes.
Security - in case of vulnerabilities.
-->

## [Unreleased]

## 1.2.0 (2021-10-08)

### Changed

+ Annotate the immutability of `Money`.
+ Annotate the mutation-free behavior of all methods of `Currency`, except `addCurrency`.

## 1.1.2 (2021-04-19)

### Changed

+ Fix `Money::fromString` phpdoc and improve type validation of arguments.

## 1.1.0 (2020-02-21)

### Changed

+ Migrated CI from **Travis CI** to **GitHub Actions**.
+ Upgraded minimum PHP version to v7.3.

### Added

+ Added `Rate::withRatio` factory method to create modified value with specific ratio.
+ Added static analyzer into CI flow.

## 1.0.3 (2019-12-05)

### Fixed

+ Reverted removal of deprecated currencies. See [#6](https://github.com/Rebilly/money/pull/6) for details.

### Added

+ Added a property to `Currency` showing that it is deprecated. 

## 1.0.2 (2019-10-21)

### Changed

+ Updated currencies list: remove deprecated, added new, rename code of others. See [#5](https://github.com/Rebilly/money/pull/5) for details.

## 1.0.1 (2019-03-05)

### Fixed

+ Fixed pretty-print formatting of negative amount of money

## 1.0.0 (2018-12-08)

Initial Release
