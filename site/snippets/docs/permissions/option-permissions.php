Each option can be set on a per user role for fine-grained permissions, for example:

```yaml
options:
  delete:
    admin: true
    editor: false
```

Or using a wildcard to change the default for all roles:

```yaml
options:
  update:
    *: false
    editor: true
```

Controlling accessibility for roles.

```yaml
# Page is not accessible and not visible for all roles except admins.
options:
  access:
    *: false
    admin: true
  list:
    *: false
    admin: true
```
