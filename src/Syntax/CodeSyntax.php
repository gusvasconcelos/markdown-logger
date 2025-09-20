<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

class CodeSyntax implements MarkdownSyntaxInterface
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
