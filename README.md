# Usercentrics Custom Blocks

A WordPress plugin that provides custom Gutenberg blocks for the Usercentrics website. This plugin was created as part of a job offer challenge for the Senior WordPress Developer role.

## Features

- **FAQ Component**: A dynamic, reusable FAQ block with question and answer pairs, similar to the layout on the Pricing page.
  - Includes schema.org markup for SEO optimization
  - Fully accessible according to WCAG 2.1 standards
  - Mobile responsive design

## Requirements

Before setting up this project, ensure you have the following installed:

- [Docker](https://www.docker.com/get-started)
- [Node.js](https://nodejs.org/) (v16 or higher)
- [PNPM](https://pnpm.io/installation) (v9.15.2 or higher)
- [Composer](https://getcomposer.org/download/)
- [@wordpress/env](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/) (`npm install -g @wordpress/env`)

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/italloleon/usercentrics-custom-blocks.git
cd usercentrics-custom-blocks
```

### 2. Install dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
pnpm install
```

### 3. Start the WordPress environment

```bash
wp-env start
```

This will set up a local WordPress environment with the plugin activated. You can access it at:
- WordPress site: http://localhost:8888
- WordPress admin: http://localhost:8888/wp-admin/ (Username: `admin`, Password: `password`)

## Development

### Building blocks

```bash
# Development mode (with watch)
pnpm run start:blocks

# Production build
pnpm run build:blocks
```

### Linting and code quality

```bash
# Lint JavaScript files
pnpm run lint:js

# Lint CSS/SCSS files
pnpm run lint:css

# Check PHP code style
composer phpcs

# Fix PHP code style automatically
composer phpcbf
```

### Creating a new block

```bash
pnpm run create-block your-block-name
```

### Testing

```bash
composer test
```

### Creating a plugin zip file

```bash
pnpm run zip
```

## WordPress Environment Configuration

The WordPress environment is configured in the `.wp-env.json` file:

- PHP Version: 8.1
- WordPress Debug Mode: Enabled
- Debug Log: Enabled
- Debug Display: Disabled

## Code Quality Tools

This project uses PHP_CodeSniffer for code quality checks and automatic code formatting.

### Git Hooks

The following Git hooks are configured:

- **pre-commit**: Automatically runs PHP Code Beautifier and Fixer (PHPCBF), PHP Code Sniffer (PHPCS), JavaScript linter, and CSS linter before allowing a commit.

### Configuration

The coding standards are defined in `phpcs.xml` in the project root. This project follows PSR-12 coding standards.

## Accessibility and SEO

### Accessibility (WCAG 2.1)

The blocks in this plugin are built with accessibility in mind:

- Semantic HTML structure
- Proper ARIA attributes
- Keyboard navigation support
- Sufficient color contrast
- Focus management

### SEO Optimization

The FAQ block includes schema.org markup for better search engine visibility:

- Uses FAQPage schema for FAQ content
- Structured data is automatically generated based on the content

## Iterative Improvements

The development approach for these blocks includes:

1. **User Feedback Collection**: Implementing analytics and feedback mechanisms
2. **A/B Testing**: Testing different designs and interactions
3. **Performance Monitoring**: Regular performance audits
4. **Accessibility Testing**: Regular audits with tools like Axe and manual testing
5. **Continuous Integration**: Automated tests to ensure quality

## License

This project is licensed under the GPL-2.0+ License - see the LICENSE file for details.

## Author

Itallo Leonardo - [GitHub](https://github.com/italloleon)
