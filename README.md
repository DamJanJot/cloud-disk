# File Manager (Personal Cloud Disk)

A simple web-based file manager that allows authenticated users to upload, view, and manage their own files.

## Features
- Upload, list, read, and edit files using AJAX
- Simple and intuitive UI
- Each user has their own upload space (recommended in future)
- JSON-based backend communication

## Technologies Used
- PHP
- JavaScript (AJAX)
- HTML/CSS

## Installation

1. Place the files on your server.
2. Create an `uploads/` folder with write permissions.
3. Make sure `file_manager.php` is secure on a logged-in session.
4. Log in as a user and navigate to `dysk.php`.

## Security Notes
- It's recommended to add per-user folders under `uploads/`.
- Validate file names to prevent directory traversal attacks.
- Restrict allowed file types for uploads (if enabled).

## License
MIT
# cloud-disk
