<?xml version="1.0" encoding="UTF-8"?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">
  <ShortName><?= site()->title()->xml() ?></ShortName>
  <Description>Search the Kirby website and documentation.</Description>
  <InputEncoding>UTF-8</InputEncoding>
  <Image width="16" height="16" type="image/x-icon"><?= url('favicon.ico') ?></Image>
  <Image width="64" height="64" type="image/png"><?= (new Kirby\Toolkit\File(kirby()->root('index') . '/opensearch.png'))->base64() ?></Image>
  <Url type="text/html" method="get" template="<?= url('search') ?>?q={searchTerms}" />
  <Url type="application/opensearchdescription+xml" rel="self" template="<?= Xml::encode(url('open-search.xml')) ?>" />
  <moz:SearchForm><?= Xml::encode(url('search')) ?></moz:SearchForm>
</OpenSearchDescription>