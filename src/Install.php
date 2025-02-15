<?php

namespace T2\Console;

class Install
{
    /**
     * 常量：IS_PLUGIN
     * 用于标识当前类是否为 T2Engine 插件
     * 值为 true，表示是 T2Engine 插件
     */
    const true IS_PLUGIN = true;

    /**
     * @var array 目录关系映射
     * 用于定义源路径和目标路径之间的关系，用于安装和卸载时的文件操作。
     */
    protected static array $pathRelation = [
        'config' => 'config',
    ];

    /**
     * 安装方法
     * 检查是否已存在指定的安装目录，如果存在则提示失败，否则执行安装逻辑。
     *
     * @return void
     */
    public static function install(): void
    {
        $dest = base_path() . "/start"; // 定义目标安装目录
        // 检查目标目录是否已存在
        if (is_dir($dest)) {
            echo "Installation failed, please remove directory $dest\n";
            return;
        }
        // 复制安装文件到目标目录
        copy(__DIR__ . "/start", $dest);
        // 设置目标目录权限
        chmod(base_path() . "/start", 0755);
        // 执行基于路径关系的安装逻辑
        static::installByRelation();
    }

    /**
     * 卸载方法
     * 删除安装目录和相关文件。
     *
     * @return void
     */
    public static function uninstall(): void
    {
        // 检查并删除目标安装文件
        if (is_file(base_path() . "/start")) {
            @unlink(base_path() . "/start");
        }
        // 执行基于路径关系的卸载逻辑
        self::uninstallByRelation();
    }

    /**
     * 根据路径关系安装相关文件
     * 遍历路径关系数组，将源文件复制到目标位置。
     *
     * @return void
     */
    public static function installByRelation(): void
    {
        foreach (static::$pathRelation as $source => $dest) {
            // 将源目录内容复制到目标目录
            copy_dir(__DIR__ . "/$source", base_path() . "/$dest");
        }
    }

    /**
     * 根据路径关系卸载相关文件
     * 遍历路径关系数组，仅删除目标路径下的 `console.php` 文件。
     *
     * @return void
     */
    public static function uninstallByRelation(): void
    {
        foreach (static::$pathRelation as $dest) {
            $file = base_path() . "/$dest/console.php"; // 目标文件路径
            // 如果目标文件存在，删除该文件
            if (is_file($file)) {
                @unlink($file);
                echo "Deleted: $file\n";
            }
        }
    }
}