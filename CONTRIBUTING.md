# Contributing to Vehicle Rental Management System

Thank you for your interest in contributing to the Vehicle Rental Management System! This document provides guidelines and information for contributors.

## 🤝 How to Contribute

### Types of Contributions

We welcome various types of contributions:

- **Bug Reports**: Report bugs and issues you encounter
- **Feature Requests**: Suggest new features or improvements
- **Code Contributions**: Submit pull requests with code changes
- **Documentation**: Improve or add documentation
- **Testing**: Help test the application and report issues
- **UI/UX Improvements**: Suggest design improvements

### Before You Start

1. **Check Existing Issues**: Search existing issues to avoid duplicates
2. **Read the Documentation**: Familiarize yourself with the project structure
3. **Set Up Development Environment**: Follow the installation guide in README.md

## 🛠️ Development Setup

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL/PostgreSQL
- Git

### Local Development

1. **Fork the Repository**
   ```bash
   git clone https://github.com/yourusername/vehicle-rental-system.git
   cd vehicle-rental-system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start Development Server**
   ```bash
   php artisan serve
   ```

## 📝 Code Style Guidelines

### PHP/Laravel Standards

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Use meaningful variable and function names
- Add comprehensive comments for complex logic
- Follow Laravel conventions and best practices

### Example Code Style

```php
/**
 * User-friendly method description
 * 
 * @param string $parameter Description of parameter
 * @return array Description of return value
 */
public function exampleMethod(string $parameter): array
{
    // Clear, descriptive comments
    $result = $this->processData($parameter);
    
    return [
        'status' => 'success',
        'data' => $result
    ];
}
```

### Database Conventions

- Use snake_case for table and column names
- Include timestamps (`created_at`, `updated_at`) in all tables
- Use meaningful foreign key names
- Add proper indexes for performance

### Frontend Standards

- Use semantic HTML
- Follow BEM methodology for CSS classes
- Ensure responsive design
- Maintain accessibility standards

## 🔄 Pull Request Process

### Creating a Pull Request

1. **Create a Feature Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make Your Changes**
   - Write clean, well-documented code
   - Add tests for new functionality
   - Update documentation if needed

3. **Test Your Changes**
   ```bash
   php artisan test
   php artisan migrate:fresh --seed
   ```

4. **Commit Your Changes**
   ```bash
   git add .
   git commit -m "feat: add new feature description"
   ```

5. **Push and Create PR**
   ```bash
   git push origin feature/your-feature-name
   ```

### Commit Message Format

Use conventional commit format:

```
type(scope): description

[optional body]

[optional footer]
```

Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

Examples:
```
feat(auth): add two-factor authentication
fix(vehicles): resolve image upload issue
docs(readme): update installation instructions
```

### Pull Request Guidelines

- **Title**: Clear, descriptive title
- **Description**: Detailed explanation of changes
- **Screenshots**: Include screenshots for UI changes
- **Testing**: Describe how to test the changes
- **Breaking Changes**: Note any breaking changes

## 🐛 Bug Reports

### Before Reporting

1. Check if the issue has already been reported
2. Try to reproduce the issue
3. Check if it's a configuration issue

### Bug Report Template

```markdown
**Bug Description**
Clear description of the bug

**Steps to Reproduce**
1. Step 1
2. Step 2
3. Step 3

**Expected Behavior**
What should happen

**Actual Behavior**
What actually happens

**Environment**
- OS: [e.g., Windows 10]
- PHP Version: [e.g., 8.1.0]
- Laravel Version: [e.g., 10.x]
- Database: [e.g., MySQL 8.0]

**Additional Information**
Screenshots, error logs, etc.
```

## 💡 Feature Requests

### Feature Request Template

```markdown
**Feature Description**
Clear description of the requested feature

**Use Case**
Why this feature is needed

**Proposed Solution**
How you think it should be implemented

**Alternative Solutions**
Other ways to solve the problem

**Additional Information**
Any other relevant details
```

## 🧪 Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/VehicleTest.php

# Run with coverage
php artisan test --coverage
```

### Writing Tests

- Write tests for new features
- Ensure good test coverage
- Use descriptive test names
- Test both success and failure cases

### Example Test

```php
public function test_user_can_create_reservation()
{
    $user = User::factory()->create();
    $vehicle = Vehicle::factory()->create(['status' => 'available']);
    
    $response = $this->actingAs($user)
        ->post('/reservations', [
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(3),
            'notes' => 'Test reservation'
        ]);
    
    $response->assertRedirect('/reservations');
    $this->assertDatabaseHas('reservations', [
        'user_id' => $user->id,
        'vehicle_id' => $vehicle->id
    ]);
}
```

## 📚 Documentation

### Documentation Standards

- Write clear, concise documentation
- Include code examples
- Keep documentation up to date
- Use proper markdown formatting

### Areas That Need Documentation

- API endpoints
- Database schema
- Configuration options
- Deployment procedures
- Troubleshooting guides

## 🔒 Security

### Security Guidelines

- Never commit sensitive data (passwords, API keys)
- Report security vulnerabilities privately
- Follow security best practices
- Validate and sanitize all user input

### Reporting Security Issues

If you discover a security vulnerability:

1. **DO NOT** create a public issue
2. Email the maintainer directly
3. Provide detailed information about the vulnerability
4. Allow time for the issue to be addressed

## 🏷️ Version Control

### Branch Naming

- `feature/feature-name`: New features
- `fix/bug-description`: Bug fixes
- `docs/documentation-update`: Documentation changes
- `refactor/component-name`: Code refactoring

### Git Workflow

1. Always work on feature branches
2. Keep commits atomic and focused
3. Write clear commit messages
4. Rebase before submitting PRs

## 🎯 Project Roadmap

### Current Priorities

- [ ] Email notifications for reservations
- [ ] Payment integration
- [ ] Mobile responsive improvements
- [ ] API documentation
- [ ] Performance optimizations

### Future Features

- [ ] Multi-language support
- [ ] Advanced reporting
- [ ] Vehicle maintenance tracking
- [ ] Customer reviews and ratings

## 📞 Getting Help

### Communication Channels

- **Issues**: Use GitHub issues for bugs and feature requests
- **Discussions**: Use GitHub discussions for questions
- **Email**: Contact maintainer for security issues

### Before Asking for Help

1. Check the documentation
2. Search existing issues
3. Try to reproduce the problem
4. Provide detailed information

## 🙏 Recognition

### Contributors

All contributors will be recognized in:

- Project README
- Release notes
- Contributor hall of fame

### Types of Recognition

- **Code Contributors**: Listed in contributors section
- **Documentation**: Credit in documentation
- **Bug Reports**: Mentioned in release notes
- **Feature Ideas**: Credit in feature descriptions

## 📄 License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing to the Vehicle Rental Management System! Your contributions help make this project better for everyone. 