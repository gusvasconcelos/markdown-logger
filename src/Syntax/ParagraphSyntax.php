<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

class ParagraphSyntax implements MarkdownSyntaxInterface
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
