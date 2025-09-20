<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class BlockquoteSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getType(): string
    {
        return 'blockquote';
    }
    
    public function __toString(): string
    {
        $lines = explode("\n", $this->text);

        $quotedLines = array_map(fn($line) => "> {$line}", $lines);

        return implode("\n", $quotedLines);
    }
}
