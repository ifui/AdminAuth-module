# Admin Auth Module

## 注意

如果使用的是 `vscode` 建议安装 `Laravel Goto Lang` 插件，并添加 `vscode` 配置

```php
"laravelGotoLang.methods": [
    "trans",
    "trans_choice",
    "__",
    "@lang",
    "success",
    "error",
    "CodeException",
]    
```

## 依赖

### Laravel Permission

默认使用 `Laravel Permission` 做权限认证，使用 `php artisan module:seed AdminAuth` 可生成一个管理员账号、角色和权限，拥有 `super-admin` 角色或者 `administrator` 权限的人将拥有站点所有权限

- 账号: ifui
- 密码: admin
- 角色: super-admin
- 权限: administrator

> 注意：建议按照 `用户->角色->权限` 的方式去鉴权
