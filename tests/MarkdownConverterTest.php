<?php

namespace Tests\GusVasconcelos\MarkdownConverter;

use GusVasconcelos\MarkdownConverter\MarkdownConverter;
use PHPUnit\Framework\TestCase;

class MarkdownConverterTest extends TestCase
{
    private $tempDir;

    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/markdown-converter-test-' . uniqid();

        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->tempDir)) {
            $files = glob($this->tempDir . '/*');

            foreach ($files as $file) {
                unlink($file);
            }

            rmdir($this->tempDir);
        }
    }

    public function testInitialization()
    {
        $converter = new MarkdownConverter();

        $this->assertInstanceOf(MarkdownConverter::class, $converter);
    }

    public function testHeading()
    {
        $converter = new MarkdownConverter();

        $converter->heading('Test Heading');

        $content = $converter->getContent();

        $this->assertStringContainsString('# Test Heading', $content);
    }

    public function testHeadingWithLevel()
    {
        $converter = new MarkdownConverter();

        $converter->heading('Test Heading', 3);

        $content = $converter->getContent();

        $this->assertStringContainsString('### Test Heading', $content);
    }

    public function testParagraph()
    {
        $converter = new MarkdownConverter();

        $converter->paragraph('Test paragraph content');

        $content = $converter->getContent();

        $this->assertStringContainsString('Test paragraph content', $content);
    }

    public function testHorizontalRule()
    {
        $converter = new MarkdownConverter();

        $converter->horizontalRule();

        $content = $converter->getContent();

        $this->assertStringContainsString('---', $content);
    }

    public function testCodeBlock()
    {
        $converter = new MarkdownConverter();

        $code = '{"name": "John Doe", "age": 30}';

        $converter->codeBlock($code, 'json');

        $content = $converter->getContent();

        $this->assertStringContainsString("```json\n{\"name\": \"John Doe\", \"age\": 30}\n```", $content);
    }

    public function testLink()
    {
        $converter = new MarkdownConverter();

        $converter->link('https://example.com', 'Example');

        $content = $converter->getContent();

        $this->assertStringContainsString('[Example](https://example.com)', $content);
    }

    public function testOrderedList()
    {
        $converter = new MarkdownConverter();

        $converter->orderedList(['Item 1', 'Item 2', 'Item 3']);

        $content = $converter->getContent();

        $this->assertStringContainsString('1. Item 1', $content);
        $this->assertStringContainsString('2. Item 2', $content);
        $this->assertStringContainsString('3. Item 3', $content);
    }

    public function testUnorderedList()
    {
        $converter = new MarkdownConverter();

        $converter->unorderedList(['Item 1', 'Item 2', 'Item 3']);

        $content = $converter->getContent();

        $this->assertStringContainsString('- Item 1', $content);
        $this->assertStringContainsString('- Item 2', $content);
        $this->assertStringContainsString('- Item 3', $content);
    }

    public function testChainedMethods()
    {
        $converter = (new MarkdownConverter())
            ->heading('Test Document')
            ->paragraph('This is a test paragraph')
            ->horizontalRule()
            ->codeBlock('console.log("Hello");', 'javascript')
            ->link('https://example.com', 'Example Site');

        $content = $converter->getContent();

        $this->assertStringContainsString('# Test Document', $content);

        $this->assertStringContainsString('This is a test paragraph', $content);

        $this->assertStringContainsString('---', $content);

        $this->assertStringContainsString("```javascript\nconsole.log(\"Hello\");\n```", $content);

        $this->assertStringContainsString('[Example Site](https://example.com)', $content);
    }

    public function testWriteMethod()
    {
        $filename = 'build-test';

        $converter = (new MarkdownConverter())
            ->heading('Build Test')
            ->paragraph('Testing build method')
            ->write($this->tempDir, $filename);

        $this->assertFileExists($this->tempDir . '/' . $filename . '.md');

        $fileContent = file_get_contents($this->tempDir . '/' . $filename . '.md');

        $this->assertStringContainsString('# Build Test', $fileContent);

        $this->assertStringContainsString('Testing build method', $fileContent);
    }

    public function testGetContent()
    {
        $converter = (new MarkdownConverter())
            ->heading('Content Test')
            ->paragraph('Testing getContent method');

        $content = $converter->getContent();

        $this->assertIsString($content);

        $this->assertStringContainsString('# Content Test', $content);

        $this->assertStringContainsString('Testing getContent method', $content);
    }
}
