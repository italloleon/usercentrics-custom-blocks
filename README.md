# Usercentrics Custom Blocks

## Code Quality Tools

This project uses PHP_CodeSniffer for code quality checks and automatic code formatting.

### Setup

After cloning the repository, run:

```bash
composer install
```

This will install all dependencies including PHP_CodeSniffer and set up Git hooks.

### Git Hooks

The following Git hooks are configured:

- **pre-commit**: Automatically runs PHP Code Beautifier and Fixer (PHPCBF) to format your code and then PHP Code Sniffer (PHPCS) to check for any remaining issues before allowing a commit.

### Manual Usage

You can also run the tools manually:

```bash
# Check code style
composer phpcs

# Fix code style automatically
composer phpcbf
```

### Configuration

The coding standards are defined in `phpcs.xml` in the project root. This project follows PSR-12 coding standards.

## Troubleshooting

If the Git hooks are not working:

1. Make sure the pre-commit hook is executable:
   ```bash
   chmod +x .git/hooks/pre-commit
   ```

2. Reinstall the hooks:
   ```bash
   vendor/bin/cghooks add --ignore-lock
   ```
