# Markdown Logger
A simple and fluent PHP library for creating Markdown files for logging purposes.

## Installation
Install the package via Composer:

```bash
composer require gusvasconcelos/markdown-logger
```

## Requirements
- PHP 7.4 or higher
- Composer

## Usage

```php
use GusVasconcelos\MarkdownLogger\MarkdownLogger;

// Initialize the logger
$logger = new MarkdownLogger();

// Create markdown content
$logger
    ->heading('API Request Log')
    ->paragraph('Request ID: 1234567890')
    ->horizontalRule()
    ->codeBlock('{"name":"John","age":30,"email":"john@example.com"}', "json")
    ->link('https://api.example.com', 'API Documentation')
    ->write(__DIR__, "example.md"); // Write to file
```

### Fluent Interface
All methods return the logger instance, allowing for method chaining:
```php
$logger = (new MarkdownLogger())
    ->heading('System Log', 2)
    ->paragraph('Timestamp: ' . date('Y-m-d H:i:s'))
    ->horizontalRule()
    ->codeBlock($errorDetails, 'php')
    ->link('https://support.example.com', 'Get Support')
    ->write(__DIR__, "example.md");
```

### Available Methods

#### heading(string \$text, int \$level = 1)
Creates a heading with the specified text and level (1-6).
```php
$logger->heading('Main Title'); // # Main Title
$logger->heading('Subtitle', 2); // ## Subtitle
```

#### paragraph(string \$text)
Adds a paragraph with the specified text.
```php
$logger->paragraph('This is a paragraph.'); // This is a paragraph.
```

#### horizontalRule()
Adds a horizontal rule (divider).
```php
$logger->horizontalRule(); // ---
```

#### codeBlock(string \$code, string \$language = null)
Adds a code block with the specified code and optional language.
```php
$logger->codeBlock('{"name":"John","age":30, "email":"john@example.com"}', 'json'); // ```json {"name":"John","age":30, "email":"john@example.com"}```
```

#### link(string \$url, string \$text)
Adds a link with the specified URL and text.
```php
$logger->link('https://example.com', 'Example Site'); // [Example Site](https://example.com)
```

#### orderedList(array \$items)
Adds an ordered list with the specified items.
```php
$logger->orderedList(['Item 1', 'Item 2', 'Item 3']); // 1. Item 1 2. Item 2 3. Item 3
```

#### unorderedList(array \$items)
Adds an unordered list with the specified items.
```php
$logger->unorderedList(['Item 1', 'Item 2', 'Item 3']); // - Item 1 - Item 2 - Item 3
```

#### write(string \$directory, string \$filename)
Writes the markdown content to the file.
```php
$logger->write(__DIR__, "example.md"); // Writes to file
```

#### getContent()
Returns the markdown content as a string.
```php
$content = $logger->getContent(); // Returns the markdown content
```

## Use Cases
- Logging API requests and responses
- Application logs
- Debugging complex data structures

## Testing

To run the tests, use the following command:

```bash
composer test
```

## License
This project is open-sourced under the MIT License - see the LICENSE file for details.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
