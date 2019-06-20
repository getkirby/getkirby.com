## Conditional sections

<since v="3.2.0">
Like (link: docs/guide/blueprints/fields#conditional-fields text: conditional fields), sections can be shown/hidden based on the value of a given field (i.e. if a toggle is checked, a select field is at a certain option, etc.).

The condition for displaying the section is set with the `when` option. In the `when` option you define a field name as the key and the required value of that field. In the following example, the each section type is shown based on a different value of the `postType` field:

```yaml
sections:
  content:
    type: fields
    fields:
      postType:
        type: select
        options:
          - Gallery
          - Image
          - Text
  gallery:
    type: files
    template: gallery-image
    layout: cards
    size: tiny
    when:
      postType: Gallery
  image:
    type: files
    template: single-image
    max: 1
    layout: cards
    when:
      postType: Image
  text:
    type: fields
    fields:
      text:
        type: textarea
      tags:
        type: tags
    when:
      postType: Text   
```
</since>
