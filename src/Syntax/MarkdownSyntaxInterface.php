<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

interface MarkdownSyntaxInterface
{
    /**
     * Retorna o tipo do elemento Markdown
     * @return string
     */
    public function getType(): string;
}
