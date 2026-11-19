## Conditional display

Like any other field, a list can be shown or hidden based on the value of another field. Set the condition with the `when` option, using a field name as the key and the value it has to have.

In the following example, each field is shown based on a different value of the `postType` field:

```yaml
fields:
  postType:
    type: select
    options:
      - Gallery
      - Image
      - Text
  gallery:
    type: filelist
    template: gallery-image
    layout: cards
    size: tiny
    when:
      postType: Gallery
  image:
    type: filelist
    template: single-image
    max: 1
    layout: cards
    when:
      postType: Image
  text:
    type: textarea
    when:
      postType: Text
  tags:
    type: tags
    when:
      postType: Text
```

See (link: docs/guide/blueprints/fields#conditional-fields text: conditional fields) for the full set of rules.
