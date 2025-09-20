<?php

namespace Tests\GusVasconcelos\MarkdownConverter;

use GusVasconcelos\MarkdownConverter\MarkdownConverter;
use GusVasconcelos\MarkdownConverter\Syntax\BoldSyntax;
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

        $content = $converter->heading('Test Heading');

        $this->assertStringContainsString('# Test Heading', $content);
    }

    public function testHeadingWithLevel()
    {
        $converter = new MarkdownConverter();

        $content = $converter->heading('Test Heading', 3);

        $this->assertStringContainsString('### Test Heading', $content);
    }

    public function testParagraph()
    {
        $converter = new MarkdownConverter();

        $content = $converter->paragraph('Test paragraph content');

        $this->assertStringContainsString('Test paragraph content', $content);
    }

    public function testHorizontalRule()
    {
        $converter = new MarkdownConverter();

        $content = $converter->horizontalRule();

        $this->assertStringContainsString('---', $content);
    }

    public function testCodeBlock()
    {
        $converter = new MarkdownConverter();

        $code = '{"name": "John Doe", "age": 30}';

        $content = $converter->codeBlock($code, 'json');

        $this->assertStringContainsString("```json\n{\"name\": \"John Doe\", \"age\": 30}\n```", $content);
    }

    public function testLink()
    {
        $converter = new MarkdownConverter();

        $content = $converter->link('https://example.com', 'Example');

        $this->assertStringContainsString('[Example](https://example.com)', $content);
    }

    public function testOrderedList()
    {
        $converter = new MarkdownConverter();

        $content = $converter->orderedList(['Item 1', 'Item 2', 'Item 3']);

        $this->assertStringContainsString('1. Item 1', $content);

        $this->assertStringContainsString('2. Item 2', $content);

        $this->assertStringContainsString('3. Item 3', $content);
    }

    public function testUnorderedList()
    {
        $converter = new MarkdownConverter();

        $content = $converter->unorderedList(['Item 1', 'Item 2', 'Item 3']);

        $this->assertStringContainsString('- Item 1', $content);

        $this->assertStringContainsString('- Item 2', $content);

        $this->assertStringContainsString('- Item 3', $content);
    }

    public function testChainedMethods()
    {
        $content = (new MarkdownConverter())
            ->heading('Test Document')
            ->paragraph('This is a test paragraph')
            ->horizontalRule()
            ->codeBlock('echo "Hello";', 'php')
            ->orderedList(['Item 1', 'Item 2', 'Item 3'])
            ->unorderedList(['Item 1', 'Item 2', 'Item 3'])
            ->bold('Bold Text')
            ->italic('Italic Text')
            ->blockquote('This is a quote')
            ->image('https://example.com/image.jpg', 'Alt text', 'Title')
            ->code('inline code')
            ->emoji('😀')
            ->link('https://example.com', 'Example Site');

        $this->assertStringContainsString('# Test Document', $content);

        $this->assertStringContainsString('This is a test paragraph', $content);

        $this->assertStringContainsString('---', $content);

        $this->assertStringContainsString("```php\necho \"Hello\";\n```", $content);

        $this->assertStringContainsString('1. Item 1', $content);

        $this->assertStringContainsString('2. Item 2', $content);

        $this->assertStringContainsString('3. Item 3', $content);

        $this->assertStringContainsString('- Item 1', $content);

        $this->assertStringContainsString('- Item 2', $content);

        $this->assertStringContainsString('- Item 3', $content);

        $this->assertStringContainsString('**Bold Text**', $content);

        $this->assertStringContainsString('*Italic Text*', $content);

        $this->assertStringContainsString('> This is a quote', $content);

        $this->assertStringContainsString('![Alt text](https://example.com/image.jpg "Title")', $content);

        $this->assertStringContainsString('`inline code`', $content);
        
        $this->assertStringContainsString('😀', $content);

        $this->assertStringContainsString('[Example Site](https://example.com)', $content);
    }

    public function testWriteMethod()
    {
        $filename = 'build-test';

        $content = (new MarkdownConverter())
            ->heading('Build Test')
            ->paragraph('Testing build method')
            ->write($this->tempDir, $filename);

        $this->assertFileExists($this->tempDir . '/' . $filename . '.md');

        $this->assertStringContainsString('# Build Test', $content);

        $this->assertStringContainsString('Testing build method', $content);
    }

    public function testToString()
    {
        $content = (new MarkdownConverter())
            ->heading('Content Test')
            ->paragraph('Testing toString method');

        $this->assertIsString((string) $content);

        $this->assertStringContainsString('# Content Test', $content);

        $this->assertStringContainsString('Testing toString method', $content);
    }

    public function testBold()
    {
        $converter = new MarkdownConverter();

        $content = $converter->bold('Bold Text');
        
        $this->assertStringContainsString('**Bold Text**', $content);
    }

    public function testItalic()
    {
        $converter = new MarkdownConverter();

        $content = $converter->italic('Italic Text');
        
        $this->assertStringContainsString('*Italic Text*', $content);
    }

    public function testBlockquote()
    {
        $converter = new MarkdownConverter();

        $content = $converter->blockquote('This is a quote');
        
        $this->assertStringContainsString('> This is a quote', $content);
    }

    public function testImage()
    {
        $converter = new MarkdownConverter();

        $content = $converter->image('https://example.com/image.jpg', 'Alt text', 'Title');
        
        $this->assertStringContainsString('![Alt text](https://example.com/image.jpg "Title")', $content);
    }

    public function testImageWithoutTitle()
    {
        $converter = new MarkdownConverter();

        $content = $converter->image('https://example.com/image.jpg', 'Alt text');
        
        $this->assertStringContainsString('![Alt text](https://example.com/image.jpg)', $content);
    }

    public function testCode()
    {
        $converter = new MarkdownConverter();

        $content = $converter->code('inline code');
        
        $this->assertStringContainsString('`inline code`', $content);
    }

    public function testEmoji()
    {
        $converter = new MarkdownConverter();

        $content = $converter->emoji('😀');
        
        $this->assertStringContainsString('😀', $content);
    }

    public function testElementManagement()
    {
        $converter = new MarkdownConverter();
        
        $content = $converter
            ->heading('Title')
            ->paragraph('Paragraph 1')
            ->paragraph('Paragraph 2');
        
        $this->assertEquals(3, $content->count());
        
        $element = $content->get(0);

        $this->assertEquals('heading', $element->getType());
        
        $content->removeAt(1);

        $this->assertEquals(2, $content->count());
        
        $content->replace(1, new BoldSyntax('Bold'));
        
        $this->assertEquals(2, $content->count());
        
        $this->assertStringContainsString('**Bold**', $content);
    }

    public function testClearElements()
    {
        $converter = new MarkdownConverter();
        
        $converter->heading('Title')->paragraph('Content');

        $this->assertEquals(2, $converter->count());
        
        $converter->clear();

        $this->assertEquals(0, $converter->count());
    }
}
