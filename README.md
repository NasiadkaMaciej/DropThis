# DropThis
Quickly upload and share your files

![Website screenshot](https://maciej.ml/projects/DropThis/main.png)  

The app was made because of frustration about the time taken to log into online drives.  
Here you simply go onto the website without even clicking anything. Enter your password, and voilà, you are ready to upload your files.  
Simply drop your files anywhere on the website, or choose them in the prompt.  
Files are uploaded automatically, and generated link to them is shown on the website.  
Simply click on the filename to copy the link to it your clipboard.  
Links are simply random strings, which are handled by a web server and PHP file to find files in DB and serve it to the user accordingly  
You can remove files too.  
The project is in beta phase, and it will surely be developed!

## Technical info

To install your own instance you will need:
- Database - You can import dropthis.sql 
- Database user
- Folder outside root directory with www-data access
- Web server configured to forward file links, mine nginx config looks like this (User always sees the nice short link):
```
location ~ ^/f(.*)$ {
    return 302 https://dropthis.ml/i?f=$1;
}
```

__After preparing, you must insert correct informaton into php files__  
I left "placeholder" in places where you need to change information