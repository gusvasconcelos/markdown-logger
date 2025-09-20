<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class HorizontalRuleSyntax implements MarkdownSyntaxInterface, Stringable
{
    public function getType(): string
    {
        return 'horizontal_rule';
    }

    public function __toString(): string
    {
        return "\n---\n";
    }
}
