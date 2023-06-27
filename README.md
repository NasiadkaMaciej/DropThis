# DropThis
### Quickly upload and share your files

![Website screenshot](https://nasiadka.pl/projects/DropThis/main.png)  

Quick, simple and safe way to upload and download your files.  
I reduced the number of required actions and input to a minimum.  
You simply go onto website and enter password without clicking anything - voilà, you are ready to upload your files.  
Drop them anywhere on the website or use prompt.  
Files are uploaded automatically, and generated link to them is shown on the website.  
Simply click on the filename to copy the link to it your clipboard.  
Links are simply random strings, which are handled by a web server and PHP file to find files in DB and serve it to the user accordingly  
If you no longer need the file, you can delete it on the website.  
Project is in beta phase, but it will surely be developed!  
[Have fun with sleek login screen](https://dropthis.ml/)

## Technical info

To install your own instance you will need:
- Database - You can import provided dropthis.sql file
- Database user
- Folder outside root directory with www-data access
- Web server configured to forward links, my nginx config looks like this (User always sees the nice short link):
```
location ~ ^/f(.*)$ {
    return 302 https://dropthis.ml/i?f=$1;
}
```

__After preparing, you must insert correct info into files__  
I left "placeholder" in places where you need to change information