# Larval 5.2 Rbac 示例

## 说明

这只是一个基于Laravel5.2 和 [zizaco/entrust](https://github.com/Zizaco/entrust)实现的RBAC的简单示例应用，通过路由名来控制权限，当然你也可以扩展一下应用到实际项目中。



## 截图

## ![laravel rbac](http://7bv7rl.com1.z0.glb.clouddn.com/536EDDB1-A462-4E60-A912-6429340BE429.png)



![rbac](http://7bv7rl.com1.z0.glb.clouddn.com/4EFB5F11-E0AD-46ED-A800-7D07A4587924.png)



![rbac](http://7bv7rl.com1.z0.glb.clouddn.com/A0BBACE4-B4D1-4FCF-AE69-B7F0014495E9.png)

## 安装

- git clone 到本地
- 执行 `composer install`
- 配置 **.local.env** 中数据库连接信息
- 执行 `php artisan db:seed`
- 执行 `php artisan serve`
- 默认后台账号:admin@admin.com 密码:admin
