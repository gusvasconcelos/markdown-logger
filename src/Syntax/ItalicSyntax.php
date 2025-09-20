<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

class ItalicSyntax implements MarkdownSyntaxInterface
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
 
    public function getType(): string
    {
        return 'italic';
    }
        
    public function __toString(): string
    {
        return "*{$this->text}*";
    }
}
