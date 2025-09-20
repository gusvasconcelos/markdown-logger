<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

class HorizontalRuleSyntax implements MarkdownSyntaxInterface
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
