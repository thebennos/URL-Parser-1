# URL-Parser
The objects and behavior of this package follow the [WHATWG URL](https://url.spec.whatwg.org/) specification.

This API offers 2 objects that you can use to help you work with URLs; [URL](#url) and [URLSearchParams](#urlsearchparams).

## URL
The URL object is the primary object for working with a URL.
### The constructor
`URL(string $url[, string $base])`

Providing an invalid URL or an invalid base URL will case the constructor to throw a `TypeError`.

```php
// Construct a new URL object.
$url = new URL('https://example.com/');

// Construct a new URL object using a relative URL, by also providing the constructor with the base URL.
$url = new URL('path/to/file.php?query=string', 'http://example.com');
```
### Members
#### `string URL::href `
The `href` getter returns the serialization of the URL.  The `href` setter will parse the entire string
updating all the components of the URL with the new values. Providing an invalid URL will cause the
setter to throw a `TypeError`.

#### `readonly string URL::origin`
The `origin` member is readonly.  Its output is in the form of `scheme://host:port`.  If a URL does not
have a port, then that will be excluded from the output.

#### `string URL::protocol`
The `protocol` getter, also known as a scheme, returns the protocol of the URL, such as http, ftp, or ssh.
The `protocol` setter is used to change the URLs protocol.

#### `string URL::username`
The `username` getter returns the username portion of the URL, or an empty string if the URL does not contain a username. The `username` setter changes the URLs username.

#### `string URL::password`
The `password` getter returns the password portion of the URL, or an empty string if the URL does not contain a password. The `password` setter changes the URLs password.

#### `string URL::host`
The `host` getter returns the combination of `hostname` and `port`. The output would look like `hostname:port`. If the URL does not have a port, then the port is not present in the output. The `host` setter allows you to change both the `hostname` and `port` at the same time.

#### `string URL::hostname`
The `hostname` getter returns the hostname of the URL. For example, the hostname of `https://example.com:31` would be `example.com`.  The `hostname` setter will change the hostname portion of the URL.

#### `string URL::port`
The `port` getter returns an integer as a string representing the URLs port. If the URL does not have a port, the empty string will be returned instead.  The `port` setter updates the URLs port.

#### `string URL::pathname`
The `pathname` getter returns the URLs path. The `pathname` setter updates the URLs path.

#### `string URL::search`
The `search` getter returns the URLs query string. The `search` setter updates the URLs URLSearchParams list.

#### `readonly URLSearchParams URL::searchParams`
Returns the URLSearchParams object associated with this URL allowing you to modify the query parameters without having to clobber the entire query string. This will always return the same object.

#### `string URL::hash`
The `hash` getter, also known as a URLs fragment, returns the portion of the URL that follows the "#" character. The `hash` setter updates the portion of the URL that follows the "#".

#### `string URL::toJSON()`
Returns a JSON encoded string of the URL. Note that this method escapes forward slashes, which is not the default for PHPs `json_encode()`, but matches the default behavior of JavaScripts `JSON.stringify()`. If you wish to control the serialization, then pass the URL obect to the `json_encode()` function.

#### `string URL::jsonSerialize()`
The URL object implements the `JsonSerializable` interface allowing you to pass the object as a whole to the json_encode() function.

## URLSearchParams
The URLSearchParams object allows you to work with query strings when you don't need a full URL.

### The constructor
`URLSearchParams([string[][]|object|string $init])`

```php
// Construct an empty list of search params.
$params = new URLSearchParams();

// Construct a new list from a query string. Remember that a leading "?" will be stripped.
$params = new URLSearchParams('?foo=bar');

// Construct a new list using an array of arrays containing strings. Alternatively, you could pass an
// object that implements the Traversable interface and whose iterator returns an array containing
// exactly 2 items.
$params = new URLSearchParams([
    ['foo', 'bar'],
    ['foo', 'bar'] // Duplicates are allowed!
]);

// Construct a new list using an object
$obj = new \stdClass();
$obj->foo = 'bar';
$params = new URLSearchParams($obj);
```

### Members
#### `void URLSearchParams::append(string $name, string $value)`
Appends a new name-value pair to the list.

#### `void URLSearchParams::delete(string $name)`
Deletes all name-value pairs whose name is `$name` from the list.

#### `string|null URLSearchParams::get(string $name)`
Returns the value of the first name-value pair whose name is `$name` in the list or null if there are no name-value pairs whose name is `$name` in the list.

#### `string[] URLSearchParams::getAll(string $name)`
Returns a list of values of all name-value pairs whose name is `$name`, in list order, or the empty list if there are no name-value pairs whose name is `$name` in the list.

#### `bool URLSearchParams::has(string $name)`
Returns true if there is a name-value pair in the list, and false otherwise.

#### `void URLSearchParams::set(string $name, string $value)`
If the list contains name-value pairs whose name is `$name`, the first name-value pair in the list whose name is `$name` will have its value changed to `$value` and all others following it in the list will be removed. If the list does not contain a name-value pair whose name is `$name` then the new name-value pair will be appended to the list.

#### `void URLSearchParams::sort()`
Sorts the list of search params by comparing code units. The relative order of name-value pairs with the same name are preserved.

#### `string[] URLSearchParams::getIterator()`
URLSearchParams implements the IteratorAggregate interface, allowing you to easily iterate over the list of search params using a `foreach` loop.  It returns an array containing exactly 2 items, the first is the pairs name, and the second is the pairs value.

#### `string URLSearchParams::toString()`
Returns the serialization of the list of name-value pairs.

#### `string URLSearchParams::__toString()`
See [URLSearchParams::toString()](#string-urlsearchparams-tostring)
