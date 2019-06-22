## Dynamic options

Our options (link: docs/guide/blueprints/query-language text: query syntax) offers a very powerful way of converting pages, files, users, page values and even items in structure fields into automatically generated option lists.

### Option queries

```yaml
fields:
  category:
    label: Category
    type: <?= $field . PHP_EOL ?>
    options: query
    query: site.children.published
```

The example above will turn all published main pages of the site into options. The title of each page will be used as the text of the option and the page id will be used as the stored value.

### A few more examples

```yaml
query: site.children.template("project").limit(10)
query: page.images.offset(2)
query: users.filterBy("role", "admin").sortBy("name", "desc")
query: page.links.toStructure
```

You can start at the `site`, current `page`, `users` collection or the `kirby` instance to run your query. The result must be a collection of `pages`, `files`, `users` or a structure object

<since v="3.2.0">

You can use array syntax and nested queries in Kirby's query syntax.

```yaml
query: site.index.filterBy("template", "in", ["note", "album"]);
query: kirby.collection("some-collection").not(kirby.collection("excluded-collection"))
```

</since>

### Getting options from all siblings or the index

```yaml
query: page.siblings.pluck("tags", ",", true)
query: page.index.pluck("tags", ",", true)
query: site.index.pluck("tags", ",", true)
```

### Custom text and value

To customize the displayed text or the stored value, you can be more specific when defining the query: The `query` option gets three suboptions, where `fetch` takes over the options query. `text` and `value` can be defined with the help of our string template language to get exactly what you want as the  result.

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query:
    fetch: site.children.published
    text: "{{ page.year }}"
    value: "{{ page.slug }}"
```

As in the example above, all custom fields of a page can be accessed. You can even combine fields and use (link: docs/reference/templates/field-methods text: field methods):

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query:
    fetch: site.children.published
    text: "{{ page.year }} - {{ page.title.upper }}"
    value: "{{ page.slug }}"
```

### Numeric keys

If you want to store numeric keys as values, you have to use the long notation with `value` and `text`:

```yaml
fields:
  category:
    label: Category
    type: <?= $field . PHP_EOL ?>
    options:
      - value: '100'
        text: Design
      - value: '200'
        text: Architecture
```

## Options from other fields

With a query it is not only possible to fetch options from pages, users, files or structure fields. You can also split comma-separated values of fields such as tags or checkboxes in order to create options from the result array.

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query: site.taxonomy.split
```

Of course you get the same flexibility with those array values, to modify the result text and stored value. Each item in the array will automatically be converted into an object with a `key` and `value` property. Those properties are regular Kirby content fields and you can use all (link: docs/reference/templates/field-methods text: field methods) to work with them further. Items in the array need to be referenced as `arrayItem`

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query:
    fetch: site.taxonomy.split
    text: "{{ arrayItem.value.upper }}"
    value: "{{ arrayItem.value.slug }}"
```

### A custom separator

If the values in a field are separated by something other than a comma, you can of course specify this as well in the query.

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query: page.categories.split(";")
```

### Options from structure field

To fetch options from a structure field, you can use the `toStructure` method and then fetch the text and value from the fields of the structure items:

Assuming we have a structure field like this:

```yaml
twitter:
  label: Follow the Kirby Team on Twitter …
  type: structure
  fields:
    name:
      label: Team Member
      type: text
    twitter:
      label: Twitter Username
      type: text
```

We can fetch the fields by using the keyword `structureItem`:

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: query
  query:
    fetch: site.contactoptions.toStructure
    text: "{{ structureItem.name }}"
    value: "{{ structureItem.twitter }}"
```


## Options via API

If the option queries are not enough or you need to pluck an external source for option data, you can use the API setting.

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: api
  api: https://your-options-api.com/options.json
```

By default, the API setting expects that the JSON endpoint returns an option array as shown above in the manual option setting.

You can be much more specific with the endpoint though and describe which kind of data to fetch and what to convert to text and value - pretty much as with the option queries.

### A simple company list example

Let's assume that our JSON endpoint returns the following JSON:

```json
{
  "Companies": [
    {"name": "Apple"},
    {"name": "Intel"},
    {"name": "Microsoft"}
  ]
}
```

As you can see, the format doesn't follow our expected option format at all. We first need to go down to the companies property and then somehow convert each company object into  text and value for the options.

This can be done with our template language:

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: api
  api:
    url: https://example.com/companies.json
    fetch: Companies
    text: "{{ item.name }}"
    value: "{{ item.name.slug }}"
```

With the `fetch` attribute we can define where to start in the JSON document. This can even go down nested structures or sort entries:

```yaml
fetch: Companies.sortBy("name", "desc")
```

The JSON document is turned into a Kirby structure and thus can be queried and manipulated just like any other data within Kirby.

Afterwards the text and value setting can be modified by defining the template for each item.

Again, each item is being converted to a Kirby object and every property of the object is a typical Kirby field with all the available field methods. We can go pretty wild with this, if we want. Let's just assume we have a little bit more data for each company …

```json
{
  "Companies": [
    {
      "name": "Apple",
      "products": [
        {"name": "MacBook"},
        {"name": "iPhone"},
        {"name": "iPad"}
      ]
    },
    {
      "name": "Intel",
      "products": [
        {"name": "Intel Core something"}
      ]
    },
    {
      "name": "Microsoft",
      "products": [
        {"name": "Windows"},
        {"name": "Hololens"},
        {"name": "Xbox"}
      ]
    }
  ]
}
```

```yaml
value: "{{ item.name.slug.upper }}"
text: "{{ item.name }} - Products: {{ item.products.count }}"
```

This would produce the following PHP array of options:

```php
[
  value: 'APPLE',
  text: 'Apple - Products: 3'
],
[
  value: 'INTEL',
  text: 'Intel - Products: 1'
],
[
  value: 'MICROSOFT',
  text: 'Microsoft - Products: 3'
]
```

### Dynamic API URLs

Instead of hard-coding an absolute URL into your blueprint, it's often better to have more control over the API URL. Especially when you are working with different environments (ie. local, staging, production)

The URL option of the API setup can also be modified by using the string template language:

```yaml
category:
  label: Category
  type: <?= $field . PHP_EOL ?>
  options: api
  api:
    url: "{{ site.url }}/my-api/companies.json"
    fetch: Companies
    text: "{{ item.name }}"
    value: "{{ item.name.slug }}"
```

With this simple addition, the API URL will always refer to the main URL of the site. You can also access the configuration instead to get even more flexibility

```yaml
url: "{{ kirby.option.optionApiUrl }}/companies.json"
```

