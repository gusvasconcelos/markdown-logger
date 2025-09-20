<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class ItalicSyntax implements MarkdownSyntaxInterface, Stringable
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
