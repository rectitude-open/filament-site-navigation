# Changelog

## [1.10.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.9.0...v1.10.0) (2025-08-09)


### Features

* add more translations ([0034908](https://github.com/rectitude-open/filament-site-navigation/commit/003490821ca435b73340e2f22e22e5804c4f8836))
* enhance SiteNavigation form with localized labels and improved action modals ([7915710](https://github.com/rectitude-open/filament-site-navigation/commit/7915710c793490fbf20082f7f1f0d526e3661aa0))

## [1.9.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.8.0...v1.9.0) (2025-07-19)


### Features

* add duplicate action to SiteNavigation tree actions ([87a7801](https://github.com/rectitude-open/filament-site-navigation/commit/87a780170ab16a01bf29f7e8c5320a7f9edcbbed))
* add root path handling to URL generation in SiteNavigation model ([c29a9ab](https://github.com/rectitude-open/filament-site-navigation/commit/c29a9ab9d8dbb8ae0742d9a7ca3b900b6484a678))

## [1.8.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.7.1...v1.8.0) (2025-07-16)


### Features

* enhance route generation logic to support child routes and prioritize routes ([cf49a2a](https://github.com/rectitude-open/filament-site-navigation/commit/cf49a2a5a3a785a12c4bd69cc970fccf6c0f6bf0))


### Bug Fixes

* remove reorderable option from route parameters key-value component ([137f07e](https://github.com/rectitude-open/filament-site-navigation/commit/137f07e9060a6e8b678539936ad04c1784fd916b))

## [1.7.1](https://github.com/rectitude-open/filament-site-navigation/compare/v1.7.0...v1.7.1) (2025-07-14)


### Bug Fixes

* remove visibility filter from all navigations retrieval in findCurrentNavigationItem method ([4679ed8](https://github.com/rectitude-open/filament-site-navigation/commit/4679ed88e4118948d8ea607583924abab0efbbe4))

## [1.7.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.6.0...v1.7.0) (2025-07-14)


### Features

* add parent relationship to SiteNavigation model ([7094053](https://github.com/rectitude-open/filament-site-navigation/commit/7094053b0d0b743d1d6718654f25b0c758f9ce80))
* implement getBreadcrumbs method in FilamentSiteNavigation class and add site_breadcrumbs helper function ([fe8f9b2](https://github.com/rectitude-open/filament-site-navigation/commit/fe8f9b2b1ecc5cb8f8c757ee1a19467c9db5f60c))

## [1.6.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.5.0...v1.6.0) (2025-07-14)


### Features

* add url attribute to SiteNavigation model for dynamic URL generation ([b2a42d4](https://github.com/rectitude-open/filament-site-navigation/commit/b2a42d442b83898b6dad99ba861295398fdea462))
* increase maxDepth from 3 to 10 for SiteNavigation class ([6d83cb5](https://github.com/rectitude-open/filament-site-navigation/commit/6d83cb52965b56a2e6a787c185259c5d5c9d1321))

## [1.5.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.4.4...v1.5.0) (2025-07-14)


### Features

* add getTreeByParentId method to FilamentSiteNavigation and site_navigations helper function ([10bf766](https://github.com/rectitude-open/filament-site-navigation/commit/10bf76610917ae80ff6f2a96b342b86d0d6e7d37))


### Bug Fixes

* optimize is_current_nav function to cache results for improved performance ([26dcbcd](https://github.com/rectitude-open/filament-site-navigation/commit/26dcbcd84b0ab30fc5844ef412e354ae84e5395f))

## [1.4.4](https://github.com/rectitude-open/filament-site-navigation/compare/v1.4.3...v1.4.4) (2025-07-07)


### Bug Fixes

* enhance is_current_nav function to check child routes ([67965d4](https://github.com/rectitude-open/filament-site-navigation/commit/67965d4a5a0f0e6191c815021a0f6fbeed68d8b5))


### Miscellaneous Chores

* clean up code using pint ([5f0c44b](https://github.com/rectitude-open/filament-site-navigation/commit/5f0c44ba877c78a0b2a01014f11946af2ff4bc56))

## [1.4.3](https://github.com/rectitude-open/filament-site-navigation/compare/v1.4.2...v1.4.3) (2025-07-07)


### Bug Fixes

* update navigation query to use active status ([19ec61b](https://github.com/rectitude-open/filament-site-navigation/commit/19ec61b5520c5d25085b9df96dc297d9a584414d))

## [1.4.2](https://github.com/rectitude-open/filament-site-navigation/compare/v1.4.1...v1.4.2) (2025-07-07)


### Bug Fixes

* add helpers to autoload ([c3c85db](https://github.com/rectitude-open/filament-site-navigation/commit/c3c85db441ed106d922f0bc64a648bef63e618d6))

## [1.4.1](https://github.com/rectitude-open/filament-site-navigation/compare/v1.4.0...v1.4.1) (2025-07-07)


### Bug Fixes

* update icon for toggle button to use eye-slash icon ([2c4cb6c](https://github.com/rectitude-open/filament-site-navigation/commit/2c4cb6c705b5644049b8c01ee3a22d263bebb383))

## [1.4.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.3.3...v1.4.0) (2025-07-07)


### Features

* add is_current_nav helper function ([a572d01](https://github.com/rectitude-open/filament-site-navigation/commit/a572d010a16106c0ec48b62a8152a0c257d3c996))
* add is_visible field ([6319123](https://github.com/rectitude-open/filament-site-navigation/commit/63191239aa6ced3d818f6f56c31a3feb96ecd90f))
* add view composer for navigation tree ([84d2bfd](https://github.com/rectitude-open/filament-site-navigation/commit/84d2bfdfbe1215ba40fa8f5531dbba6b469575e2))


### Bug Fixes

* update return type in getModel method to use SiteNavigation class ([86ff0b0](https://github.com/rectitude-open/filament-site-navigation/commit/86ff0b07174659fa966678be10f2d393049dd9f8))

## [1.3.3](https://github.com/rectitude-open/filament-site-navigation/compare/v1.3.2...v1.3.3) (2025-07-01)


### Bug Fixes

* remove ordered scope method in SiteNavigation model ([b308f6f](https://github.com/rectitude-open/filament-site-navigation/commit/b308f6f3d58dd4587095ec99fd34ae2e7a557112))

## [1.3.2](https://github.com/rectitude-open/filament-site-navigation/compare/v1.3.1...v1.3.2) (2025-06-30)


### Bug Fixes

* change visibility of query scope methods to protected in SiteNavigation model ([beb88d1](https://github.com/rectitude-open/filament-site-navigation/commit/beb88d14acd97686780f7871a465ffff5fcc0f93))

## [1.3.1](https://github.com/rectitude-open/filament-site-navigation/compare/v1.3.0...v1.3.1) (2025-06-30)


### Bug Fixes

* add missing import for Scope attribute in SiteNavigation model ([2895469](https://github.com/rectitude-open/filament-site-navigation/commit/2895469c59eecf4f5254bfe737348f573c167d78))

## [1.3.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.2.0...v1.3.0) (2025-06-30)


### Features

* add GeneratesBreadcrumbs trait for breadcrumb generation functionality ([7b0e6c3](https://github.com/rectitude-open/filament-site-navigation/commit/7b0e6c330f48d48110b8df147b43fb4d30fd240c))
* add query scopes for active, inactive, and ordered navigation entries ([af7f585](https://github.com/rectitude-open/filament-site-navigation/commit/af7f5852962bcdcef98b19da706375b088171ff7))
* implement getModel method to retrieve the configured model for SiteNavigation ([d425e71](https://github.com/rectitude-open/filament-site-navigation/commit/d425e710b7fc7bbd113e31ab890c5c53694f2aa8))

## [1.2.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.1.1...v1.2.0) (2025-06-29)


### Features

* introduce child_routes instead of child_controller_action ([eebbac6](https://github.com/rectitude-open/filament-site-navigation/commit/eebbac6bb44d4b7fe80721037111ab07c7fa08b2))


### Bug Fixes

* enhance route name generation for navigation entries ([fe56443](https://github.com/rectitude-open/filament-site-navigation/commit/fe5644326c28364c680834cc26a584a051409a5a))

## [1.1.1](https://github.com/rectitude-open/filament-site-navigation/compare/v1.1.0...v1.1.1) (2025-06-27)


### Bug Fixes

* improve code readability by adding space in route parameters check ([53ddce0](https://github.com/rectitude-open/filament-site-navigation/commit/53ddce05cd59584c001622eb7466015dd579816d))
* streamline route parameter handling in GenerateNavigationRoutes command ([db006e8](https://github.com/rectitude-open/filament-site-navigation/commit/db006e87d862aa1463843cee6816fef48a674834))

## [1.1.0](https://github.com/rectitude-open/filament-site-navigation/compare/v1.0.0...v1.1.0) (2025-06-26)


### Features

* add route booting functionality to FilamentSiteNavigationServiceProvider ([4ea8287](https://github.com/rectitude-open/filament-site-navigation/commit/4ea8287f08ad4cb5615da9864f5bee86024e87f5))
* change url to path ([cf57a7d](https://github.com/rectitude-open/filament-site-navigation/commit/cf57a7d2ac78d8fb97faaa423bee08f29128a9a6))
* enhance site navigation model and routes configuration ([0168a1b](https://github.com/rectitude-open/filament-site-navigation/commit/0168a1bfe7faff6310c5b3b413932571a354fe20))
* implement SiteNavigationObserver and RegenerateNavigationRoutes listener for route management ([a0f86f6](https://github.com/rectitude-open/filament-site-navigation/commit/a0f86f68fcef9e7096b20686afb0e92523dab815))


### Miscellaneous Chores

* update credits in README to reflect new contributor ([69903a1](https://github.com/rectitude-open/filament-site-navigation/commit/69903a1425ed4ec481a2a0d0294a7381c6c3707c))

## 1.0.0 (2025-05-21)


### Features

* init navigation page ([5c64726](https://github.com/rectitude-open/filament-site-navigation/commit/5c6472625ccbdbd7ad8b62d4af7acbda690a74e4))
* init package name ([55b2d94](https://github.com/rectitude-open/filament-site-navigation/commit/55b2d9460e4ad946be4b24df4d7b4da536c92cb9))
