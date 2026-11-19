<?php

// namespaced, as PHP 8.4 declares a global `Deprecated` attribute class
namespace TestDeprecated;

/**
 * @deprecated 5.0.0 This is deprecated
 */
class Deprecated
{
}

class DeprecatedNot
{
}

/**
 * @deprecated 5.0.0
 */
class DeprecatedOnlyVersion
{
}

/**
 * @deprecated
 */
class DeprecatedOnlyTag
{
}
