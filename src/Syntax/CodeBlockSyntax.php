<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

use Stringable;

class CodeBlockSyntax implements MarkdownSyntaxInterface, Stringable
{
    private string $code;

    private string $language;

    public function __construct(string $code, string $language = "")
    {
        $this->code = $code;

        $this->language = $language;
    }

    public function getType(): string
    {
        return 'code_block';
    }
    
    public function __toString(): string
    {
        return "```{$this->language}\n{$this->code}\n```";
    }
}
