<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class BoldSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
    
    public function getType(): string
    {
        return 'bold';
    }
    
    public function __toString(): string
    {
        return "**{$this->text}**";
    }
}
