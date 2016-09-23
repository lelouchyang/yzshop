<?php
namespace app\modules\auth\controllers\admin;

use Yii;
use \app\mysite\web\AdminController;
use \app\mysite\models\AuthRole;
use \app\mysite\models\SysAction;

/**
 * @name 角色管理控制器
 * @admin_panel 10
 */
class RoleController extends AdminController
{
    /**
     * @name 角色管理
     * @menu true
     */
    public function actionIndex()
    {
        $actions = [];
        $this->view->title = '角色分组管理';
        return $this->render('index', [
            'actions' => $actions
        ]);
    }

    /**
     * @name 添加/编辑角色
     */
    public function actionEdit()
    {
        $action = $this->request->get('action');
        if ( !in_array($action, ['add', 'update']) ) {
            http404();
        }

        return $this->$action();
    }


    /**
     * 添加角色
     */
    protected function add()
    {
        if ( $this->Request->isPost ) {
            $post = $this->request->post();

            $role = new AuthRole();
            $role->name = $post['name'];
            $role->des = $post['des'];
            $role->save();

            return $this->json([
                'datas'  => $post,
                'msg'    => '成功添加角色组',
                'status' => 1
            ]);
        }
        $role = new AuthRole();
        $role->loadDefaultValues();
        return $this->renderPartial('edit', ['role'=>$role]);
    }

    /**
     * 编辑角色
     */
    protected function update()
    {
        if ( $this->request->isPost ) {
            $id = $this->request->post('id');
            $role = AuthRole::findOne($id);
            $role->name = $this->request->post('name');
            $role->des = $this->request->post('des');
            $role->save();
            return $this->json([
                'datas' => null,
                'msg' => '更新成功',
                'status' => 1
            ]);
        }
        $id = $this->request->get('id');
        $role = AuthRole::findOne($id);
        return $this->renderPartial('edit', [
            'role' => $role
        ]);
    }

    /**
     * @name 删除角色
     */
    public function actionDel()
    {
        $id = $this->request->get('id');
        $role = AuthRole::findOne($id);
        $role->status = 0;
        $role->save();
        return $this->json([
            'datas'  => null,
            'msg'    => '删除成功',
            'status' => 1
        ]);

    }

    /**
     * @name 角色权限分配
     */
    public function actionEditAction()
    {
        if ( $this->request->isPost ) {
            $option = $this->request->post('option');
            $datas = [
                'role_id' => $this->request->post('role_id'),
                'action_id' => $this->request->post('action_id'),
            ];
            $db = Yii::$app->db;
            if ( $option == 'add' ) {
                $db->createCommand()->insert('auth_role_action', $datas)->execute();
            } else {
                $db->createCommand()->delete('auth_role_action', $datas)->execute();
            }
            return $this->json([null, 'ok', 1]);
        }

        $roles = (new AuthRole)->find()->where(['status'=>1])->all();
        $id = $this->request->get('id', $roles[0]['id']);
        $role = AuthRole::findOne($id);
        $hasActions = $role->hasActions();
        $actions = SysAction::getAdminActions();

        /*
        $jumpAuthCheck = Yii::$app->params['jumpAuthCheck'];
        foreach( $jumpAuthCheck as &$item ) {
            $item = str2num($item);
        } unset($item);
        */

        $jumpAuthCheck = [];

        $this->view->title = "角色权限编辑";
        return $this->render('editAction', [
            'role'          => $role,
            'roles'         => $roles,
            'actions'       => $actions,
            'hasActions'    => $hasActions,
            'jumpAuthCheck' => $jumpAuthCheck,
        ]);
    }

}

