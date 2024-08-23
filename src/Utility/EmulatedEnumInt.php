<?php

namespace Brick\DateTime\Utility;

class EmulatedEnumInt {

    protected int $value;

    protected function __construct(int $value) {

            $this->value = $value;
    }

    public function __toString() : string {
            return (string) $this->value;
    }
}
