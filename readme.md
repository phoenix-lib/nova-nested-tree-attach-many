# Nova Nested Tree Attach Many

[![Latest Version on Github](https://img.shields.io/github/release/phoenix-lib/nova-nested-tree-attach-many.svg?style=flat-square)](https://packagist.org/packages/phoenix-lib/nova-nested-tree-attach-many)
[![Total Downloads](https://img.shields.io/packagist/dt/phoenix-lib/nova-nested-tree-attach-many.svg?style=flat-square)](https://packagist.org/packages/phoenix-lib/nova-nested-tree-attach-many)

Belongs To Many Field for simple manage Nested relation tree. Enables attaching relationships easily.

![nova-nested-tree-attach-many](https://user-images.githubusercontent.com/74270064/98738291-8a872780-23b8-11eb-8c76-a8605abe69f8.gif)

### Installation

```bash
composer require phoenix-lib/nova-nested-tree-attach-many
```

### Usage

This field uses tree provided by kalnoy/nestedset package

This field uses riophae/vue-treeselect under the hood

```php
use NovaPackage\NestedTreeAttachMany\NestedTreeAttachManyField;
```
```php
public function fields(Request $request)
{
    return [
        NestedTreeAttachManyField::make('Offer Categories',"categories","App\Nova\Category"),
    ];
}
```

### Options

Here are a few customization options

- `->searchable(bool $searchable)`
- `->withIdKey(string $idKey = 'id')` // - id column name in your nested model
- `->withLabelKey(string $labelKey = 'name')` // - label column name in your nested model
- `->withChildrenKey(string $childrenKey)` // - children key in your nested model
- `->withPlaceholder(string $placeholder)` // - placeholder in tree select
- `->withMaxHeight(int $maxHeight)`
- `->withSortValueBy(string $sortBy)` // - @see https://vue-treeselect.js.org/#flat-mode-and-sort-values
- `->withAlwaysOpen(boot $alwaysOpen)` // - by default select is open, but you can change it behavior


### Authorization
This field also respects policies: ie Role / Permission
- RolePolicy: attachAnyPermission($user, $role)
- RolePolicy: attachPermission($user, $role, $permission)
- PermissionPolicy: viewAny($user)


### Contributing
Feel free to suggest changes, ask for new features or fix bugs yourself.

Hope this package will be useful for you.
---

