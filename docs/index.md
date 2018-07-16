# What are Enums?

A fixed set of constants. In PHP there is no built in support for
this, so we created a package that gets us close. Check out [this](https://stackoverflow.com/questions/4709175/what-are-enums-and-why-are-they-useful)
stackoverflow thread for more context.

## Key Features

- Enum objects can be used for type hint checking
- Simply interface
- Built in inflectors for common use case scenarios

# Basic Usage

Many developers already have classes that are dedicated to holding
a set of constants. With this package you can maintain that pattern
and simply extend the base enum to have the functionality.

## Example

Imagine the following lose example.

~~~ php
// EventType.php
class EventType
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
}

// EventManager.php
class EventManager 
{
    public funtion createEvent(string $type)
    {
        $event = new Event();
        $event->setType($type);
        
        return $event;
    }
} 
~~~

In this example the class `EventType` is used to hold a set of 
constants, which is great, but there is no way good way to check
in `createEvent` that the value of `$type` is a valid `EventType`.

This can be fixed by making this an enum. To convert this to an 
enum start by extending the base class.

~~~ php
use ZingleCom\Enum\AbstractEnum;

// EventType.php
class EventType extend AbstractEnum
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
}
~~~

As you can see, this won't be a breaking change, but you now have 
a few added abilities. The most important is type checking. To 
intialize a new enum object instantiate a new `EventType` with 
the value:

~~~ php
// This will throw a EnumException if the value is invalid.
$type = new EventType(EventType::CREATED);
~~~

Notice this is first place where some validation will occur. Now
you can update your method to accept this type.

~~~ php
// EventManager.php
class EventManager 
{
    public funtion createEvent(EventType $type)
    {
        $event = new Event();
        $event->setType($type);
        
        return $event;
    }
} 
~~~

When you need the actual value of the enum object you have the 
`getValue` method that will return the underlying value.
