<info>
Kirby's objects are immutable. That means, when you modify an object like `$page`, `$file` etc. using a method like `update()`, `changeTitle()` and so on, a new  object is returned. Therefore, you have to store the returned object in a new variable to be able to further work with it.
</info>

