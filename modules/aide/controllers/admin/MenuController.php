<?php
namespace app\modules\aide\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\helpers\Url;
use \yii\web\NotFoundHttpException;
use \app\mysite\models\SysMenu;
use \app\mysite\models\SysAction;

/**
 * @name 菜单管理
 * @panel 10
 */
class MenuController extends AdminController
{

    /**
     * 菜单初始化
     */
    public function actionInit()
    {
        \app\mysite\helpers\ActionHelper::menuInit();
        $this->redirect(Url::to(['/aide/admin/menu/index']));
    }


    /**
     * @name 后台菜单管理
     * @menu true
     */
    public function actionIndex()
    {
        $currPanelId = $this->request->get('p_id', 1);

        $sysPanel = Yii::$app->params['sysPanel'];

        $menus = SysMenu::find()->where(['panel_id'=>$currPanelId])
                                ->orderby('path asc')
                                ->all();

        return $this->render('index', [
            'menus'       => $menus,
            'currPanelId' => $currPanelId,
            'sysPanel'    => $sysPanel,
        ]);
    }


    /**
     * @name 添加/编辑菜单
     */
    public function actionEdit()
    {
        $action = $this->request->get('action', 'add');
        if ( !in_array($action, ['add', 'update']) )
        {
            throw New NotFoundHttpException();
        }
        return $this->$action();
    }

    /**
     * @name 添加菜单
     * @menu true
     */
    protected function add()
    {
        if ( $this->Request->isPost ) {
            $menu = new SysMenu(); 
            $post = $this->request->post();
            $menu->setAttributes($post, false);
            $menu->save();
            $this->redirect(Url::to(['/aide/admin/menu']));
        }

        $parent_id = $this->request->get('parent_id', 0);

        $menus = SysMenu::find()
               ->where(['level' => 1])
               ->asArray()
               ->all();

        $menus = \app\mysite\helpers\ArrayHelper::map($menus, 'id', 'name');

        $action_menus = SysAction::getAdminMenus();

        $menu = (new SysMenu())->loadDefaultValues();

        $datas = [
            'menu'         => $menu,
            'menus'        => $menus,
            'action_menus' => $action_menus,
            'parent_id'    => $parent_id
        ];

        $this->view->title = "添加菜单";
        return $this->render('edit', $datas);

    }

    /**
     * @name 编辑菜单
     */
    protected function update()
    {
        if ( $this->Request->isPost ) {
            $id = $this->request->post('id');
            $menu = (new SysMenu())->findOne($id); 
            $post = $this->request->post();
            $menu->setAttributes($post, false);
            $menu->save();
            $this->redirect(Url::to(['/aide/admin/menu/index']));
        }

        $id = $this->request->get('id', 0);
        $menu = SysMenu::findOne($id);

        $menus = SysMenu::find()
               ->where(['level' => 1])
               ->asArray()
               ->all();

        $menus = \app\mysite\helpers\ArrayHelper::map($menus, 'id', 'name');

        $action_menus = SysAction::getAdminMenus();

        $datas = [
            'menu'         => $menu,
            'menus'        => $menus,
            'action_menus' => $action_menus,
        ];

        $this->view->title = "编辑菜单";
        return $this->render('edit', $datas);
    }

    /**
     * @name 删除菜单
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $menu = SysMenu::findOne($id);
        if ( $menu->hasChild() ) {
            return $this->json([
                'msg' => '菜单不为空',
                'status' => 0
            ]);
        }
        $menu->delete();
        return $this->json([
            'msg' => '删除成功',
            'status' => 1
        ]);
    }
    

}

