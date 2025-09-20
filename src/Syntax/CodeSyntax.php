<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class CodeSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function __toString(): string
    {
        return "`{$this->code}`";
    }

    public function getType(): string
    {
        return 'code';
    }
}
