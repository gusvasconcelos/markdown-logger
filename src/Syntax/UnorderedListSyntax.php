<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class UnorderedListSyntax implements MarkdownSyntaxInterface, Stringable
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getType(): string
    {
        return 'unordered_list';
    }

    public function __toString(): string
    {
        return implode("\n", array_map(fn($item) => "- {$item}", $this->items));
    }
}
