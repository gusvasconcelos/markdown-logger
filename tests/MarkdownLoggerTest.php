<?php

namespace Tests\GusVasconcelos\MarkdownLogger;

use GusVasconcelos\MarkdownLogger\MarkdownLogger;
use PHPUnit\Framework\TestCase;

class MarkdownLoggerTest extends TestCase
{
    private $tempDir;
    
    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/markdown-logger-test-' . uniqid();

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
        $logger = new MarkdownLogger();

        $this->assertInstanceOf(MarkdownLogger::class, $logger);
    }
    
    public function testHeading()
    {
        $logger = new MarkdownLogger();

        $logger->heading('Test Heading');

        $content = $logger->getContent();
        
        $this->assertStringContainsString('# Test Heading', $content);
    }
    
    public function testHeadingWithLevel()
    {
        $logger = new MarkdownLogger();

        $logger->heading('Test Heading', 3);
        
        $content = $logger->getContent();
        
        $this->assertStringContainsString('### Test Heading', $content);
    }
    
    public function testParagraph()
    {
        $logger = new MarkdownLogger();

        $logger->paragraph('Test paragraph content');

        $content = $logger->getContent();
        
        $this->assertStringContainsString('Test paragraph content', $content);
    }
    
    public function testHorizontalRule()
    {
        $logger = new MarkdownLogger();

        $logger->horizontalRule();

        $content = $logger->getContent();
        
        $this->assertStringContainsString('---', $content);
    }
    
    public function testCodeBlock()
    {
        $logger = new MarkdownLogger();

        $code = '{"name": "John Doe", "age": 30}';

        $logger->codeBlock($code, 'json');

        $content = $logger->getContent();
        
        $this->assertStringContainsString("```json\n{\"name\": \"John Doe\", \"age\": 30}\n```", $content);
    }
    
    public function testLink()
    {
        $logger = new MarkdownLogger();

        $logger->link('https://example.com', 'Example');

        $content = $logger->getContent();
        
        $this->assertStringContainsString('[Example](https://example.com)', $content);
    }
    
    public function testChainedMethods()
    {
        $logger = (new MarkdownLogger())
            ->heading('Test Document')
            ->paragraph('This is a test paragraph')
            ->horizontalRule()
            ->codeBlock('console.log("Hello");', 'javascript')
            ->link('https://example.com', 'Example Site');
            
        $content = $logger->getContent();
        
        $this->assertStringContainsString('# Test Document', $content);

        $this->assertStringContainsString('This is a test paragraph', $content);

        $this->assertStringContainsString('---', $content);

        $this->assertStringContainsString("```javascript\nconsole.log(\"Hello\");\n```", $content);

        $this->assertStringContainsString('[Example Site](https://example.com)', $content);
    }
    
    public function testWriteMethod()
    {
        $filename = 'build-test';

        $logger = (new MarkdownLogger())
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
        $logger = (new MarkdownLogger())
            ->heading('Content Test')
            ->paragraph('Testing getContent method');
            
        $content = $logger->getContent();

        $this->assertIsString($content);

        $this->assertStringContainsString('# Content Test', $content);

        $this->assertStringContainsString('Testing getContent method', $content);
    }
}