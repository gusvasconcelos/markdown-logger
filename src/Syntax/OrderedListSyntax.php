<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class OrderedListSyntax implements MarkdownSyntaxInterface, Stringable
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getType(): string
    {
        return 'ordered_list';
    }
    
    public function __toString(): string
    {
        return implode(
            "\n", 
            array_map(fn($item, $index) => ($index + 1) . ". {$item}", $this->items, array_keys($this->items))
        );
    }
}
