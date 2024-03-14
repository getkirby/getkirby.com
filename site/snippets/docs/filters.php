Method            | Function
----------------- | --------
`==`              | all values that match exactly
`!=`              | all values that don't match
`in`              | takes an array as parameter, matches all values that are included in the array
`not in`          | takes an array as parameter, matches all values that are not included in the array
`>`               | all values that are greater than the given value
`>=`              | all values that are greater or equal the given value
`<`               | all values that are smaller than the given value
`<=`              | all values that are smaller or equal the given value
`*=`              | all values that contain the given string
`!*=`             | all values that don't contain the given string
`^=`              | all values that start with the given string
`!^=`             | all values that don't start with the given string
`$=`              | all values that end with the given string
`!$=`             | all values that don't end with the given string
`*`               | all values that match the given regular expression
`!*`              | all values that don't match the given regular expression
`between` or `..` | takes an array as parameter with two parameters; first is the min value, second is the max value
`maxlength`       | all values that have the given maximum length
`minlength`       | all values that have the given minimum length
`maxwords`        | all values that have the given maximum amount of words
`minwords`        | all values that have the given minimum amount of words
`date ==`         | all date values that exactly match the given date string
`date !=`         | all date values that don't match the given date string
`date >`          | all date values that are later than the given date string
`date >=`         | all date values that are later or equal the given date string
`date <`          |  all date values that are earlier than the given date string
`date <=`         |  all date values that are earlier or equal the given date string
`date between` or `date ..` | all date values that are between the given date strings
