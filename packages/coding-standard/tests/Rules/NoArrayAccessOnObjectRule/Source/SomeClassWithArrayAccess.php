<?php

declare(strict_types=1);

namespace Symplify\CodingStandard\Tests\Rules\NoArrayAccessOnObjectRule\Source;

use ArrayAccess;

final class SomeClassWithArrayAccess implements ArrayAccess
{
    public function offsetExists($offset)
    {
    }

    public function offsetGet($offset)
    {
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
    }
}