<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class ParagraphSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getType(): string
    {
        return 'paragraph';
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
