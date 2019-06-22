<since v=3.2.0">

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

</since>