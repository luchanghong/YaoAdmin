# YaoAdmin
一个基于角色的访问控制（RBAC）管理后台

PHP框架：[CodeIgniter](https://github.com/bcit-ci/CodeIgniter)

前端：[BootStrap](http://www.bootcss.com/)

# 使用方法

## 安装

```
git clone https://github.com/luchanghong/YaoAdmin.git
```

## 修改配置文件

主要是数据库和session的一些简单配置

- 数据库配置

基本数据库sql文件为[yaoadmin.sql](https://github.com/luchanghong/YaoAdmin/blob/master/yaoadmin.sql)，可以直接导入本地库

```
application/config/database.php
```
修改连接本地数据库的用户名和密码即可

- 其他配置

```
application/config/config.php
```

- nginx配置


```
server {
    listen 80;
    server_name yaoadmin.com;

    error_page   500 502 /500.html;

    root /Users/lch/work/mine/YaoAdmin/yaoAdmin;

    access_log /usr/local/var/log/yaoadmin_access.log;
    error_log /usr/local/var/log/yaoadmin_error.log;

    location ~ ^/(static|upload|agreement.html)/ {
        root /Users/lch/work/mine/YaoAdmin/yaoAdmin;
        break;
    }

    if (!-e $request_filename) {
        rewrite ^(.*)$ /index.php/$1 last;
    }

    location ~ {
        set $path_info "";
        set $real_script_name $fastcgi_script_name;
        if ($fastcgi_script_name ~ "^(.+?\.php)(/.+)$") {
            set $real_script_name $1;
            set $path_info $2;
        }

        fastcgi_buffers 8 128k;

        root /Users/lch/work/mine/YaoAdmin/yaoAdmin;
        fastcgi_pass 127.0.0.1:9001;
        fastcgi_index index.php;
        # fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param SCRIPT_FILENAME $document_root$real_script_name;
        fastcgi_param SCRIPT_NAME $real_script_name;
        fastcgi_param PATH_INFO $path_info;
        include fastcgi_params;
    }
}
```

这里使用的是*php-fpm*的**9001**端口来做php解析

## 使用

本地配置好虚拟域名或者IP，然后打开`http://www.XXX.com/admin`

基础数据库里的管理员默认用户名：`admin	`，密码：`admin`，角色：`超级管理员`，也可以直接向数据库插入新的用户信息来测试
