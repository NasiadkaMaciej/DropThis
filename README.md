# DropThis
### Quickly upload and share your files

![Website screenshot](https://nasiadka.pl/projects/DropThis/main.png)  

## How to upload a file?
1. Enter the password to access the website.
2. Drag and drop your files anywhere on the website, or use the file upload prompt.
3. Your files will be automatically uploaded, and a unique link will be generated for each file.
4. Click on the filename to copy the link to your clipboard for easy sharing.


[Have fun with sleek login screen](https://dropthis.tk/)

## Technical info

To install your own instance, you will need:
- Database - You can import the provided dropthis.sql file
- Database user
- Folder outside the root directory with www-data access
- Web server configured to forward links. My nginx config looks like this (User always sees the nice short link):
```
location ~ ^/f(.*)$ {
    return 302 https://dropthis.tk/i?f=$1;
}
```

__After preparing, you must insert the correct information into the config.php file__  

I recommend setting up fail2ban to detect the 403 error that is being shown after a few failed login attempts.

