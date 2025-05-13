<?php

namespace GusVasconcelos\MarkdownLogger;

class MarkdownLogger
{
    private string $directory;

    private string $filename;
    
    private array $content = [];

    public function __construct(string $directory, string $filename)
    {
        $this->directory = rtrim($directory, '/');

        $this->filename = $filename;
    }

    public function heading(string $text, int $level = 1): self
    {
        $prefix = str_repeat('#', $level);

        $this->content[] = "$prefix $text";

        return $this;
    }

    public function horizontalRule(): self
    {
        $this->content[] = "---";

        return $this;
    }

    public function paragraph(string $text): self
    {
        $this->content[] = $text;

        return $this;
    }

    public function codeBlock(string $code, string $language = ""): self
    {
        $this->content[] = "```$language\n$code\n```";

        return $this;
    }

    public function link(string $url, string $text): self
    {
        $this->content[] = "[$text]($url)";

        return $this;
    }

    public function build(): self
    {
        $content = implode("\n\n", $this->content);

        $filePath = $this->directory . '/' . $this->filename;
        
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }
        
        file_put_contents($filePath, $content);
        
        return $this;
    }
    
    public function getContent(): string
    {
        return implode("\n\n", $this->content);
    }
}
