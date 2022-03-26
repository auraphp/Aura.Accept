# CHANGELOG

## 4.0.0
- Fix - Undefined offset notice for name and value in AbstractNegotiator by @gomboc in https://github.com/auraphp/Aura.Accept/pull/14
- Updated license from BSD to MIT by @koriym in https://github.com/auraphp/Aura.Accept/pull/17
- Enable PHP 7.2-8.1 compatibility by @koriym in https://github.com/auraphp/Aura.Accept/pull/16
- Updated scrutinizer config by @harikt in https://github.com/auraphp/Aura.Accept/pull/18

## 2.2.5

- Fixed bug when quality value was float, the array key was becoming zero.
Now converted to string https://github.com/auraphp/Aura.Accept/pull/10
- phpunit added to `require-dev` of composer. https://github.com/auraphp/Aura.Accept/pull/12
- CHANGES.md file removed, added CHANGELOG.md.

## 2.2.4

- Fixed undefined offset notice when `$_SERVER['HTTP_ACCEPT']` value is `*;q=..` and not `*/*;q=..` format. See [issue 8](https://github.com/auraphp/Aura.Accept/issues/8) for more details.

## 2.2.3

- This is a hygiene release to update the license year and remove a branch alias.

## 2.2.2

- This is a hygiene release to update the documentation and support files.
- This release modifies the testing structure and updates other support files.


## 2.2.1

- This is a hygiene release to update the documentation and support files.

## 2.2.0

- ADD: Make AbstractNegotiator::set() and add() public. Fixes #4.

## 2.1.0

- Allow wildcards as $available values for negotiation; on matching an available wildcard, the available wildcard is returned as the negotiated value.

## 2.0.0

- Initial 2.0 stable release.

## 2.0.0-beta1

- Initial 2.0 beta release (after extraction from Aura.Web).
