<?php
use \app\mysite\helpers\Url;
?>
<table class="sui-table" style="font-size:15px">
    <tbody>
        <tr>
            <td>前台博客聚合页面</td>
            <td>
            <a target="_blank" href="<?=Url::to(['/blog.html'])?>">/blog.html</a>
            </td>
        </tr>
        <tr>
            <td>前台个人博客首页</td>
            <td>
                <a target="_blank" href="<?=Url::to(['/blog/user.html', 'id'=>100])?>">/blog/user.html?id=100</a>
            </td>
        </tr>
        <tr>
            <td>移动端个人博客首页</td>
            <td>
                <a target="_blank" href="<?=Url::to(['/m/blog/user', 'id'=>100])?>">/m/blog/user.html?id=100</a>
            </td>
        </tr>
        <tr>
            <td>后台文字博客页面</td>
            <td>
                <a target="_blank" href="<?=Url::to(['/admin/blog/text'])?>">/admin/blog/text.html</a>
            </td>
        </tr>
        <tr>
            <td>后台视频博客页面</td>
            <td>
                <a target="_blank" href="<?=Url::to(['/admin/blog/video'])?>">/admin/blog/video.html</a>
            </td>
        </tr>
        <tr>
            <td>博客API演示</td>
            <td>
                <a target="_blank" href="<?=Url::to(['/api/blog/list/user', 'id'=>100])?>">/api/blog/list/user?id=100</a>
            </td>
        </tr>
    <tbody>
</table>
