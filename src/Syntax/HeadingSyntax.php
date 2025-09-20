<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class HeadingSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $text;

    private int $level;

    public function __construct(string $text, int $level = 1)
    {
        $this->text = $text;

        $this->level = max(1, min(6, $level));
    }
    
    public function getType(): string
    {
        return 'heading';
    }
    
    public function __toString(): string
    {
        $prefix = str_repeat('#', $this->level);

        return "{$prefix} {$this->text}";
    }
}
