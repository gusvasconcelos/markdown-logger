<?php

namespace GusVasconcelos\MarkdownConverter\Syntax;

class LinkSyntax implements MarkdownSyntaxInterface
{
    private string $url;

    private string $text;
    
    private ?string $title;

    public function __construct(string $url, string $text, ?string $title = null)
    {
        $this->url = $url;

        $this->text = $text;

        $this->title = $title;
    }

    public function getType(): string
    {
        return 'link';
    }
    
    public function __toString(): string
    {
        $result = "[{$this->text}]({$this->url}";
        
        if ($this->title !== null) {
            $result .= " \"{$this->title}\"";
        }
        
        $result .= ")";
        
        return $result;
    }
}
