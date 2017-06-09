# 基于 Laravel 5.4 和 EasyWechat 微信开发

## 环境

#### 系统

- 操作系统 CentOS 7.3 （64位）

- Web中间件 Nginx 1.1.12

- 数据库 Mysql 5.7.18

- PHP 7.1.15


#### 框架及扩展

- Laravel Framework 5.4.23 - 框架

- laravel-wechat 3.0 - 微信接口

- intervention/image 2.3 - 图片处理


基本功能已经完成，因为阿里云的服务器备案一直没下来，给客户开发的需求已经完成了，

没有域名去调用微信接口，其他的想法没法实现，需要等待域名备案下来后再开发后续功能

## 可以实现

- 自定义菜单

- 海报推广活动的后台及微信端

## 使用

```shell
# 将代码下载
$ git clone https://github.com/BroQiang/wechat.git laravel-wechat

# 恢复依赖关系
$ composer install

# 修改配置文件

# 复制 .env.example 为 .env
$ cp .env.example .env

# 编辑 .env 文件

# 1. 修改数据库为自己的
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_user
DB_PASSWORD=your_password

# 2. 修改邮箱配置为自己的，用来重置密码，如果不需要可以不配置
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null

# 3. 修改微信的配置，需要到公众号中去找
WECHAT_APPID=your_appid
WECHAT_SECRET=your_secret
WECHAT_TOKEN=your_token
WECHAT_AES_KEY=your_aes_key

# 4. 修改默认的用户名和邮箱
ADMIN_EMAIL=broqiang@qq.com # 登录用户名
ADMIN_NAME=Admin # 页面显示的姓名
IS_REGISTER=false # 是否允许注册

# 初始化数据库
$ php artisan migrate

# 创建初始用户，根据配置文件中的默认用户去生成，默认密码是 123@123
$ php artisan db:seed

# 启动服务，可以看后台的效果了，这只是临时测试，如果正式环境，请自行配置文集的web ，如 nginx
$ php artisan serve

```


上面的配置完成后，在浏览器中访问 [http://127.0.0.1:8000/backed](http://127.0.0.1:8000/backed) ，就可以看效果了

可以自定义菜单，并创建海报，在页面中有说明文档，按照文档操作即可

现在功能较少，等域名备案下来后会陆续添加新的功能

## 更新日志

#### 2017-06-09

功能全部完成，客户已经上线

#### 2017-05-27
    
- 完成了自定义菜单的后台和发布

- 完成了海报活动的后台
